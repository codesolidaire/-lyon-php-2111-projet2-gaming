<?php

/*
 * Fichier à vocation de tester le flux RSS
 * Ouvrir un serveur sur un port différent pour accéder au flux
 */
$url = "http://localhost:8000/rss"; /* "insérer ici l'adresse du flux RSS de votre choix  */
$rss = simplexml_load_file($url);
echo '<ul>';
foreach ($rss->channel->item as $item) {
    $datetime = date_create($item->pubDate);
    $date = date_format($datetime, 'd M Y, H\hi');
    echo '<li><a href="' . $item->link . '">' . ($item->title) . '</a> (' . $date . ')</li>';
}
echo '</ul>';
