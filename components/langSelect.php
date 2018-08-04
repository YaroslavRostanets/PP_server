<?php
/**
 * Created by PhpStorm.
 * User: Yaroslav
 * Date: 17.07.2018
 * Time: 23:51
 */

    $languages = require ROOT."/config/languages.php";

    $lang_url = ( isset($_SERVER['REDIRECT_URL']))? $_SERVER['REDIRECT_URL'] : '/';

    foreach ($languages as $key => $value) {
        $lang_url = str_replace("/$key", '', $lang_url);
    }

?>

<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle js-toggle-lang">
        <div class="flag-cont"
             style="background-image: url(<?= TEMPLATE . $languages[$language]['img'] ?>)">
        </div>
        <?= $languages[$language]['title'] ?>
    </button>
    <ul class="dropdown-cont">
        <? foreach ($languages as $key => $value) : ?>
            <? if($key == $language) continue; ?>
            <li>
                <a href="<?= "/$key" . $lang_url ?>">
                    <div class="flag-cont"
                         style="background-image: url(<?= TEMPLATE . $value['img'] ?>)">
                    </div>
                    <?= $value['title'] ?>
                </a>
            </li>
        <? endforeach; ?>
    </ul>
</div>
<script>
    sessionStorage.setItem('language', '<?= $languages[$language]['title'] ?>');
</script>
