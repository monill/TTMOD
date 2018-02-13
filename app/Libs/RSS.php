<?php

namespace App\Libs;

class RSS
{
    // @ Variable Holding Parser
    public $SimpleParser;
    //@ Feed Source URL
    public $feedUrl;
    //@ Variables to Hold the Data
    public $title = "";
    public $description = "";
    public $link = "";
    public $author = "";
    public $pubDate = "";
    public $insideitem = false;
    public $tag = "";

    public function __construct($myFeed)
    {
        //To begin, I create an instance of the XML parser
        // creates a new XML parser and returns a reousurce handle referencing
        $this->SimpleParser = xml_parser_create();

        // Assigns the Feed Source to the Member Variable
        $this->feedUrl = $myFeed;

        // allows to use parser inside object
        xml_set_object($this->SimpleParser, $this);
        // Sets the element handler functions for the XML parser parser
        xml_set_element_handler($this->SimpleParser, "XmlParserFirstElement", "XmlParserendElement");
        // Sets the character data handler function for the XML parser parser
        xml_set_character_data_handler($this->SimpleParser, "characterData");

        // Call to Parser Function
        $this->ParseFeed();
    }

    private function __clone() { }

    public function XmlParserFirstElement($parser, $tagName, $attrs)
    {
        //The Function Will be called, when ever the XML_PARSER Encounters a start Tag, in the XML File
        if ($this->insideitem) {
            $this->tag = $tagName;
        } elseif ($tagName == "ITEM") {
            $this->insideitem = true;
        }
    }

    public function XmlParserendElement($parser, $tagName)
    {
        //The Function Will be called, when ever the XML_PARSER Encounters a end Tag, in the XML File
        if ($tagName == "ITEM") {
            //Display the Title Element from the XML file to HTML
            printf("<dt><strong><a href='%s'>%s</a></strong></dt><br>", trim($this->link), htmlspecialchars(trim($this->title)));
            //printf("<dd>%s</dd>",htmlspecialchars(trim($this->description)));
            // Description element is made to display in HTML
            // Deallocation of all Global Variables
            $this->title = "";
            $this->description = "";
            $this->link = "";
            $this->insideitem = false;
        }
    }

    //Function will be called by the Parser when the end tage of the element is processed. Requires Two Permeters
    public function characterData($parser, $data)
    {
        //Permeters: the parser instance and the string containing the data.
        if ($this->insideitem) {
            switch ($this->tag) {
                case "TITLE":
                    $this->title .= $data;
                    break;
                case "DESCRIPTION":
                    $this->description .= $data;
                    break;
                case "LINK":
                    $this->link .= $data;
                    break;
            }
        }
    }

    public function ParseFeed()
    {
        // This is the Place we need to Do error Handling for the XML file, which is not done in this class
        // Open the XML file for reading.
        // This part will be executed when we compiler is Unable to Open the XML Feed
        $fp = fopen($this->feedUrl, "r") or die("Oops!!! Unexpected Error While Reading the Feed");

        // This part will be executed when we compiler is Unable to Open the XML Feed
        while ($data = fread($fp, 4096)) {
            xml_parse($this->SimpleParser, $data, feof($fp));
        }
        //Perform Some Clean Up Work Before Closing the File.
        //Closing the XML File
        fclose($fp);
        //Release the XML Parser
        xml_parser_free($this->SimpleParser);
    }
}
