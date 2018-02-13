<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>IP blocked</title>
		<style>
			li { margin-top:0.5em;margin-bottom:0.5em; }
			input, textarea { width:100%; max-width:20em; font-size:1.2em; border:1px solid #ddd; color:#666; 	padding:0.3em;background:#fff;}
			textarea { height:5em }
			.recaptcha_frame { display:none; margin-top:0.5em; margin-bottom:0.5em; padding-bottom:0.5em; padding-top:0.5em; border-top:1px solid #ddd; border-bottom:1px solid #ddd; }
			.btnsubmit { font-size:1.2em; padding:0.3em; background:#383; color:white; padding-left:1em; padding-right:1em; margin-top:0.5em; cursor:pointer }
			.btnsubmit:hover { background: #494; }
			.stop_notice_message { color:#866; font-weight:bold; margin:0.5em; margin-bottom:1em; }
			.body_3 { margin-top:0em; }
			html.captcha .recaptcha_frame { display:block; }
			.error { margin-bottom:0.5em; margin-top:0.5em; padding:0.5em; background:#fee; border:1px solid #daa; color:#800 }
			#content { margin:3%;padding:1.5em;border:1px solid #ccc;border-radius:5px;background:#f8f8f8;box-shadow:1px 1px #eee;}
			body { font-family:Raleway, Verdana, Arial; background:#eee;padding:3em;color:#555; }

			@media only screen and (max-width:40em) {
				body { padding:0.2em; background:#fff; font-size:0.9em; }
				#content { padding:0em; border:none; background:#fff; box-shadow:none; }
			}
		</style>
		<script>
			function openFeedback () {
				document.getElementById('recaptcha_frame').style.display = 'block';
				document.getElementById('clickhere').style.display = 'none';
			}
		</script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
	</head>
	<body style="">

		<div id="content">

			We're sorry, but your IP address (<b>{{ip}}</b>) has been blocked from this site.  This could happen for a number of reasons:
			<ol>
				<li>
					You requested a very large number of pages in a very short time, causing problems for our server (this can happen if you hit 'refresh' over and over).
				</li>

				<li>
					You could have been banned by mistake; sometimes our automated banning policies are too strict and some IP addresses are banned by accident.  If you don't think that you've done anything to warrant a ban, this is most likely the case.
				</li>

				<li>
					You (or someone with the same IP address as you) might be using a script or program to download pages from this site automatically.  This is forbidden by our terms of service.
				</li>

				<li>
					You might have a buggy browser extension installed. Did you install a browser extension (such as Realplayer/Realdownloader) that helps you download YouTube videos or other content? If so, you'll need to disable it when using this site, as it spams the websites you visit with fake requests.
				</li>

				<li>
					You might be using a VPN.  If you are using a VPN, and other users of the same VPN are abusing the service, then you'll be automatically banned as well. <br>
					There's not much we can do about this right now; you'll have to turn off your VPN in order to continue using the site. <br>
					We are hoping to eventually work on a solution for this when we have the resources to do so.
				</li>

				<li>
					Your computer may be infected with malware or spyware that is making automated requests to our server and causing problems.
				</li>

				<li>
					<b> Firefox users </b>: There is a <a href="https://bugzilla.mozilla.org/show_bug.cgi?id=1349921" target="_blank"> bug </a> in Firefox versions 50-54 which is causing the browser to DOS our site with hundreds of thousands of false requests. If you're seeing this often and are using Firefox, try using a different browser until version 55 is released.
				</li>
			</ol>

			<span id="clickhere">You can request being unbanned by clicking <a href="javascript:openFeedback()">here</a> and completing the form.</span>
			Please be sure to add any information that might help us understand why you might have been banned.

			<form id="sec_verify" method="post" action="#">

				<input type="hidden" name="return_url" value="" />

				<div id="recaptcha_frame" class="recaptcha_frame">

					<p>Step 1: Confirm you are human</p>

					<div class="g-recaptcha" data-sitekey="6LeKVv8SAAAAAMKThIl7xn5jJ3CnB6qtTf_7sqg8"></div>

					<p>Step 2 (optional): Enter any other comments/feedback here</p>

					<textarea name="feedback" id="feedback" placeholder=""></textarea>

					<p>Step 3: Enter your email address. <b style="color:maroon">(Required)</b> </p>

					<input name="email" id="email" placeholder="" />

					<a onClick="document.getElementById('sec_verify').submit();" class="btnsubmit">Submit &gt;</a>
				</div>

			</form>

			<div class="body_3"> </div>

			<br />

			 Regards,<br />
			 Site - Staff
		</div>

	</body>
</html>
