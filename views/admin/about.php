<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 30.07.2018
 * Time: 19:17
 */
?>

<? include_once ROOT."/layouts/header.php" ?>
<? include_once ROOT."/layouts/sidebar.php" ?>

<div class="main-panel">
    <!-- Navbar -->
    <? include_once ROOT."/layouts/navbar.php" ?>
    <!-- End Navbar -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="about-cont card strpied-tabled-with-hover">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <? $i = 0; ?>
                            <? foreach ($aboutContent as $key => $value) : ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= ($i == 0)? 'active' : '' ?>"
                                       id="<?= $value['lang'] ?>-tab"
                                       data-toggle="tab" href="#<?= $value['lang'] ?>"
                                       role="tab" aria-controls="<?= $value['lang'] ?>" aria-selected="true"><?= $value['lang'] ?></a>
                                </li>
                            <? $i++ ?>
                            <? endforeach; ?>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <? $i = 0; ?>
                            <? foreach ($aboutContent as $key => $value) : ?>
                            <div class="tab-pane fade <?= ($i == 0)? 'show active' : '' ?>"
                                 id="<?= $value['lang'] ?>" role="tabpanel" aria-labelledby="<?= $value['lang'] ?>-tab">
                                <form action="#" class="js-about-form" data-lang="<?= $value['lang'] ?>">
                                    <div class="form-group">
                                        <label for="title_<?= $value['lang'] ?>">Title</label>
                                        <input type="text"
                                               class="form-control js-one-field"
                                               id="title_<?= $value['lang'] ?>"
                                               data-name="title"
                                               value="<?= $value['title'] ?>"
                                               placeholder="Введите название страницы">
                                        <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div>
                                    <div class="btn-toolbar" data-role="editor-toolbar"
                                         data-target="#editor_<?= $value['lang'] ?>">
                                        <div class="btn-group">
                                            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <li><a data-edit="fontSize 5" class="fs-Five">Huge</a></li>
                                                <li><a data-edit="fontSize 3" class="fs-Three">Normal</a></li>
                                                <li><a data-edit="fontSize 1" class="fs-One">Small</a></li>
                                            </ul>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Text Highlight Color"><i class="fa fa-paint-brush"></i>&nbsp;<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <p>&nbsp;&nbsp;&nbsp;Text Highlight Color:</p>
                                                <li><a data-edit="backColor #00FFFF">Blue</a></li>
                                                <li><a data-edit="backColor #00FF00">Green</a></li>
                                                <li><a data-edit="backColor #FF7F00">Orange</a></li>
                                                <li><a data-edit="backColor #FF0000">Red</a></li>
                                                <li><a data-edit="backColor #FFFF00">Yellow</a></li>
                                            </ul>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Font Color"><i class="fa fa-font"></i>&nbsp;<b class="caret"></b></a>
                                            <ul class="dropdown-menu">
                                                <p>&nbsp;&nbsp;&nbsp;Font Color:</p>
                                                <li><a data-edit="foreColor #000000">Black</a></li>
                                                <li><a data-edit="foreColor #0000FF">Blue</a></li>
                                                <li><a data-edit="foreColor #30AD23">Green</a></li>
                                                <li><a data-edit="foreColor #FF7F00">Orange</a></li>
                                                <li><a data-edit="foreColor #FF0000">Red</a></li>
                                                <li><a data-edit="foreColor #FFFF00">Yellow</a></li>
                                            </ul>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn btn-default" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                                            <a class="btn btn-default" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                                            <a class="btn btn-default" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                                            <a class="btn btn-default" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn btn-default" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
                                            <a class="btn btn-default" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
                                            <a class="btn btn-default" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-outdent"></i></a>
                                            <a class="btn btn-default" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn btn-default" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                                            <a class="btn btn-default" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                                            <a class="btn btn-default" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                                            <a class="btn btn-default" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
                                            <div class="dropdown-menu input-append">
                                                <input placeholder="URL" type="text" data-edit="createLink" />
                                                <button class="btn" type="button">Add</button>
                                            </div>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn btn-default" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-unlink"></i></a>
                                            <span class="btn btn-default" title="Insert picture (or just drag & drop)" id="pictureBtn"> <i class="fa fa-picture-o"></i>
						<input class="imgUpload" type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
					</span>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn btn-default" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                                            <a class="btn btn-default" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                                            <a class="btn btn-default" data-edit="html" title="Clear Formatting"><i class='glyphicon glyphicon-pencil'></i></a>
                                        </div>
                                    </div>
                                    <div id="editor_<?= $value['lang'] ?>" class="lead js-editor js-one-field" data-name="text">
                                        <?= $value['text'] ?>
                                    </div>
                                    <div id="editorPreview"></div>

                                    <a class="btn btn-large btn-default js-send-form" href="javascript:void(0);" >Сохранить</a>
                                </form>

                            </div>
                            <? $i++ ?>
                            <? endforeach; ?>
                        </div>


                    </div>
                </div>
            </div>
        </div>

        </div>
    </div>
</div>

<div class="js-save-window">
    <i class="fa fa-floppy-o" aria-hidden="true"></i>
    Сохранено
</div>

<script>
    $('.js-editor').wysiwyg();

    $(document).ready(function(){
        $('.js-send-form').on('click', function () {
            var form = $(this).closest('.js-about-form');

            var formObj = {};

            form.find('.js-one-field').each(function(i,item){
                formObj[$(item).attr('data-name')] = ( $(item).val() )? $(item).val() : $(item).html();
                console.log(item);
            });

            formObj.lang = form.attr('data-lang');

            $.ajax({
                url: "/admin/ajax?about-update",
                type: 'POST',
                cache: false,
                data: formObj,
                dataType: 'text',
                success: function(respond){
                    console.log(respond);
                    if(respond){
                        $('.js-save-window').fadeIn(75, function(){
                            var _ = $(this);
                            setTimeout(function(){
                                _.fadeOut(1000);
                            },500);
                        });
                    }
                }
            });


            console.log(formObj);
        });
    });
</script>

<? include_once ROOT."/layouts/footer.php" ?>
