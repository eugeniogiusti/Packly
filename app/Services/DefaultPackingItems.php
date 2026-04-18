<?php

namespace App\Services;

class DefaultPackingItems
{
    public static function forType(string $type): array
    {
        $common = [
            ['name' => 'Passaporto / Carta d\'identità', 'category' => 'documents', 'order' => 1],
            ['name' => 'Assicurazione viaggio',           'category' => 'documents', 'order' => 2],
            ['name' => 'Prenotazione hotel',              'category' => 'documents', 'order' => 3],
            ['name' => 'Biglietti / boarding pass',       'category' => 'documents', 'order' => 4],
            ['name' => 'Caricatore telefono',             'category' => 'tech',      'order' => 1],
            ['name' => 'Power bank',                      'category' => 'tech',      'order' => 2],
            ['name' => 'Cuffie',                          'category' => 'tech',      'order' => 3],
            ['name' => 'Spazzolino e dentifricio',        'category' => 'hygiene',   'order' => 1],
            ['name' => 'Shampoo',                         'category' => 'hygiene',   'order' => 2],
            ['name' => 'Deodorante',                      'category' => 'hygiene',   'order' => 3],
            ['name' => 'Medicinali base',                 'category' => 'hygiene',   'order' => 4],
        ];

        $specific = match($type) {
            'beach' => [
                ['name' => 'Costume da bagno',     'category' => 'clothes',     'order' => 1],
                ['name' => 'T-shirt',              'category' => 'clothes',     'order' => 2],
                ['name' => 'Pantaloncini',         'category' => 'clothes',     'order' => 3],
                ['name' => 'Infradito',            'category' => 'clothes',     'order' => 4],
                ['name' => 'Felpa serale',         'category' => 'clothes',     'order' => 5],
                ['name' => 'Crema solare',         'category' => 'hygiene',     'order' => 5],
                ['name' => 'Doposole',             'category' => 'hygiene',     'order' => 6],
                ['name' => 'Occhiali da sole',     'category' => 'accessories', 'order' => 1],
                ['name' => 'Telo da mare',         'category' => 'gear',        'order' => 1],
                ['name' => 'Adattatore prese',     'category' => 'tech',        'order' => 4],
            ],
            'business' => [
                ['name' => 'Camicia/e',            'category' => 'clothes',     'order' => 1],
                ['name' => 'Blazer',               'category' => 'clothes',     'order' => 2],
                ['name' => 'Pantaloni eleganti',   'category' => 'clothes',     'order' => 3],
                ['name' => 'Scarpe eleganti',      'category' => 'clothes',     'order' => 4],
                ['name' => 'Laptop',               'category' => 'tech',        'order' => 4],
                ['name' => 'Caricatore laptop',    'category' => 'tech',        'order' => 5],
                ['name' => 'Adattatore prese',     'category' => 'tech',        'order' => 6],
                ['name' => 'Biglietti da visita',  'category' => 'accessories', 'order' => 1],
                ['name' => 'Penna e blocco note',  'category' => 'accessories', 'order' => 2],
                ['name' => 'Cintura',              'category' => 'accessories', 'order' => 3],
            ],
            'mountain' => [
                ['name' => 'Base layer termico',   'category' => 'clothes',     'order' => 1],
                ['name' => 'Pile / felpa calda',   'category' => 'clothes',     'order' => 2],
                ['name' => 'Giacca impermeabile',  'category' => 'clothes',     'order' => 3],
                ['name' => 'Pantaloni trekking',   'category' => 'clothes',     'order' => 4],
                ['name' => 'Calze tecniche',       'category' => 'clothes',     'order' => 5],
                ['name' => 'Scarponi da trekking', 'category' => 'gear',        'order' => 1],
                ['name' => 'Zaino da giorno',      'category' => 'gear',        'order' => 2],
                ['name' => 'Bastoncini',           'category' => 'gear',        'order' => 3],
                ['name' => 'Torcia frontale',      'category' => 'gear',        'order' => 4],
                ['name' => 'Kit pronto soccorso',  'category' => 'gear',        'order' => 5],
                ['name' => 'Crema solare',         'category' => 'hygiene',     'order' => 5],
                ['name' => 'Occhiali da sole',     'category' => 'accessories', 'order' => 1],
            ],
            'city' => [
                ['name' => 'T-shirt (3x)',         'category' => 'clothes',     'order' => 1],
                ['name' => 'Pantaloni',            'category' => 'clothes',     'order' => 2],
                ['name' => 'Scarpe comode',        'category' => 'clothes',     'order' => 3],
                ['name' => 'Felpa / maglione',     'category' => 'clothes',     'order' => 4],
                ['name' => 'Adattatore prese',     'category' => 'tech',        'order' => 4],
                ['name' => 'Borsa / zaino giorno', 'category' => 'accessories', 'order' => 1],
                ['name' => 'Occhiali da sole',     'category' => 'accessories', 'order' => 2],
            ],
            default => [],
        };

        return array_merge($common, $specific);
    }
}
