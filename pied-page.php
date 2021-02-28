</section>
<footer>
    <span id="signature"><?php echo _('Copyright © 2021 Les Beaters du Québec. All Rights Reserved.'); ?></span>
        <form action="traitement-langue.php">
            <select name="langue" id="langue">
                <option value="fr" <?php if($urlLocale == "fr"){echo 'selected';} ?>>Français</option>
                <option value="en" <?php if($urlLocale == "en"){echo 'selected';} ?>>Anlgais</option>
            </select>
            <input type="hidden" id="page" name="page" value="<?php echo basename($_SERVER['PHP_SELF'])?>">
            <input class="inputLangue" type="submit" value="<?php echo _('Changer'); ?>">
            <a class="rss" href="rss.php">
            <img class="imgRSS" src="images/Generic_Feed-icon.svg.png" alt="Voir le code source pour les RSS"></img>
        </a><!--<a href="sitemap.php"><img class="imgRSS" src="images/sitemap.png" alt="Voir le code source pour le sitemap"></img></a>-->
        </form>
</footer>
</body>
</html>