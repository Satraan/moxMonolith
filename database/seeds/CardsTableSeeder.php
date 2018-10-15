<?php

use Illuminate\Database\Seeder;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Card::create([

            "id" => 1,
            "oracle_id" => "b2cefcd6-4b81-479c-86ff-1695b836972c",
            "uri"=> "https://api.scryfall.com/cards/27427233-da58-45af-ade8-e0727929efaa",
            "scryfall_uri"=> "https://scryfall.com/card/jou/152/kruphix-god-of-horizons?utm_source=api",

            "name" => "Kruphix, God of Horizons",
            "cmc"=> 5.0,
            "type_line"=> "Legendary Enchantment Creature — God",
            "oracle_text"=> "Indestructible\nAs long as your devotion to green and blue is less than seven, Kruphix isn't a creature.\nYou have no maximum hand size.\nIf you would lose unspent mana, that mana becomes colorless instead.",
            "mana_cost"=> "{3}{G}{U}",

            "colors"=> ["G", "U"],
            "color_identity"=> ["G", "U"],
            "set"=> "jou",
            "set_name"=> "Journey into Nyx",
            "collector_number"=> "152",
            "rarity"=> "mythic",

            "image_uris" => [
                "small"=> "https://img.scryfall.com/cards/small/en/jou/152.jpg?1517813031",
                "normal"=> "https://img.scryfall.com/cards/normal/en/jou/152.jpg?1517813031",
                "large"=> "https://img.scryfall.com/cards/large/en/jou/152.jpg?1517813031",
                "png"=> "https://img.scryfall.com/cards/png/en/jou/152.png?1517813031",
                "art_crop"=> "https://img.scryfall.com/cards/art_crop/en/jou/152.jpg?1517813031",
                "border_crop"=> "https://img.scryfall.com/cards/border_crop/en/jou/152.jpg?1517813031"
          ],
        ]);
    }
}
