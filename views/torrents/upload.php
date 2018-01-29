<?php

use App\Libs\Helper;

?>


<div class="col-md-8 col-md-offset-2">
    <section class="panel">

        <header class="panel-heading"> URL: </header>

        <div class="panel-body">
            <form class="form-horizontal" action="<?= URL; ?>/torrentupload" method="post" enctype="multipart/form-data" autocomplete="off">
                <input type="hidden" name="token" value="<?php echo isset($this->token) ? $this->token : ''; ?>" />
                <input type="hidden" name="formulario" value="uploadtorrent">

                <div class="form-group">
                    <label class="col-lg-2 col-sm-2 control-label">Arquivo *.torrent </label>
                    <div class="col-md-8">
                        <input type="file" name="torrent">
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label class="col-lg-2 col-sm-2 control-label">Nome do Torrent</label>
                    <div class="col-md-5">
                        <input type="text" name="nome" class="form-control">
                        <p class="help-block">(Tirado do nome do arquivo se não especificado. Use nomes descritivos.)</p>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label class="col-lg-2 col-sm-2 control-label">Poster </label>
                    <div class=" col-md-8">
                        <input type="file" name="poster">
                    </div>
                </div>
                <hr>
                <p> Imagens 1 ao 3, não são totalmente necessárias.</p>
                <div class="form-group">
                    <label class="col-lg-2 col-sm-2 control-label">Imagem 1 </label>
                    <div class=" col-md-8">
                        <input type="file" name="imagem1">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-2 col-sm-2 control-label">Imagem 2 </label>
                    <div class=" col-md-8">
                        <input type="file" name="imagem2">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-2 col-sm-2 control-label">Imagem 3 </label>
                    <div class=" col-md-8">
                        <input type="file" name="imagem3">
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label class="col-lg-2 col-sm-2 control-label">Categoria</label>
                    <div class="col-md-2">
                        <select class="form-control" name="categoria_id" id="categoria_id">
                            <?php foreach (isset($this->categorias) ? $this->categorias : '' as $categoria): ?>
                                <option value="<?= intval($categoria['id']) ?>"><?= Helper::escape($categoria['nome']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label class="col-lg-2 col-sm-2 control-label">Mostrar Uploader?</label>
                    <div class="col-md-8">
                        <div class="checkboxes">
                            <label class="label_check" for="checkbox-01">
                                <input name="showuploader" value="sim" type="checkbox" checked="checked" /> Check para sim.
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label class="col-lg-2 col-sm-2 control-label">Freeleech?</label>
                    <div class="col-md-8">
                        <div class="checkboxes">
                            <label class="label_check" for="checkbox-01">
                                <input name="freeleeach" value="sim" type="checkbox" /> Check para sim.
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label class="col-lg-2 col-sm-2 control-label">Liberar comentários:</label>
                    <div class="col-md-8">
                        <div class="checkboxes">
                            <label class="label_check" for="checkbox-01">
                                <input name="comentarios" value="sim" type="checkbox" checked="checked"/> Check para sim.
                            </label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label class="col-lg-2 col-sm-2 control-label">Descrição:</label>
                    <div class="col-md-8">
                        <textarea class="form-control descricao" name="descricao" rows="8"></textarea>
                    </div>
                </div>

                <hr>
                <p class="text-center"> Aguarde seu arquivo ser analisado pelo nosso servidor para liberação do download. </p>
                <div class="form-group">
                    <div class="col-lg-offset-5 col-lg-10">
                        <button type="submit" class="btn btn-danger">Enviar</button>
                    </div>
                </div>

            </form>
        </div>
    </section>
</div>
