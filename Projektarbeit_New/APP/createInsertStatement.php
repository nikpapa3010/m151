<pre>
<?php
echo "insert into Mietobjekt (KoerpergroesseVon, KoerpergroesseBis, Altersgruppe, Geschlecht, PreisProTag, ObjekttypFK, BildLink)\nvalues\n";
$genders = ['"m"', '"w"', '"d"', '"u"'];
$objekttypen = [
  1 => [
    '"https://www.ski.expert/media/image/2f/d7/f3/18_ikonic-84ti.jpg"',
    '"https://www.ski.expert/media/image/29/41/f5/20_v-shape-v8_315220.jpg"',
    '"https://www.xspo.ch/media/image/85/61/be/18_vantage-x-80-cti_AASS01744.jpg"'
  ],
  2 => [
    '"https://www.ski.expert/media/image/21/40/91/17_rc4-wc-sl-men-fis_A04017.jpg"',
    '"https://www.ski.expert/media/image/94/dc/98/18_racetiger-sl-pro_118021_neu.jpg"',
    '"https://www.overtons.com/dw/image/v2/BCJK_PRD/on/demandware.static/-/Sites-global-master-catalog/default/dwc145dd43/images/large/308432_1.jpg"'
  ],
  3 => [
    '"https://images.sidelineswap.com/production/001/912/175/93ab4d1c67cede82_small.jpeg"',
    '"https://i.pinimg.com/originals/cd/44/6a/cd446a86af2db41f76b17b12af50367b.jpg"',
    '"https://i.ebayimg.com/images/g/hewAAOSws4FemlkX/s-l300.jpg"'
  ],
  4 => [
    '"https://contents.mediadecathlon.com/p1329615/2000x2000/sq/ski_freeride_randonnee_fr_900_petrole_noir_wedze_8511977_1329615.jpg"',
    '"https://freeride-ski.com/wp-content/uploads/2016/12/k2-darkside-skis-2013-174.jpg"',
    '"https://i.pinimg.com/originals/36/68/ce/3668ceb5af62eb6d2aecadec81238aa9.jpg"'
  ],
  5 => [
    '"https://fun-sport-vision.com/media/image/37/cb/62/nidecker_tracer_regular_2020_gross.jpg"',
    '"https://cdn.ccs.com/media/catalog/product/cache/4/image/9df78eab33525d08d6e5fb8d27136e95/g/n/gnu-asym-zoid-c2x-snowboard-2018-159-regular-1.1506693160.jpg"',
    '"http://content.backcountry.com/images/items/900/STC/STC001N/ONECOL.jpg"'
  ],
  6 => [
    '"https://www.ridersheaven.com/media/image/product/115058/md/gnu_women_snowboard_cc_ladies_zoid_149_ec2_btx_2016_2.jpg"',
    '"https://m.media-amazon.com/images/I/4193IsQ8qqL.jpg"',
    '"https://images.evo.com/imgp/700/75392/346728/forum-recon-snowboard-sample-2014-.jpg"'
  ]];
$altersgruppe = [
  '"Kind"' => [ 80, 100, 120, 140, 160, 180 ],
  '"Jugendlich"' => [ 140, 160, 180, 200, 220, 240, 251 ],
  '"Erwachsen"' => [ 140, 160, 180, 200, 220, 240, 251 ]
];
$preis = [
  '"Kind"' => [ 20, 30, 30, 30, 20, 20 ],
  '"Jugendlich"' => [ 50, 80, 80, 80, 50, 50 ],
  '"Erwachsen"' => [ 70, 100, 100, 100, 70, 70 ]
];

foreach ($altersgruppe as $ag => $groessen) {
  for ($gr = 0; $gr < count($groessen)-1; $gr++) {
    foreach ($objekttypen as $ot => $bilder) {
      foreach ($genders as $gen) {
        foreach ($bilder as $bild) {
          echo '   (' . $groessen[$gr] . ', ' . ($groessen[$gr+1] - 1) . ', ' . $ag . ', ' .
            $gen . ', ' . $preis[$ag][$ot-1] . ', ' . $ot . ', ' . $bild . "),\n";
        }
      }
    }
  }
}
?>
</pre>