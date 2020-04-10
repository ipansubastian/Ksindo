<?php

/*
 * Kelas Model untuk pengelolaan kamus.
 */

class Kamus_model
{


    private $db;


    public function __construct()
    {
        $this->db = new Database();
    }


    // Fungsi untuk mengambil kosakata sesua keyword yang dicari.
    public function selectVocabularies($data)
    {

        /*
         * Return hanya berisi data jika data yang dikirim dari browser dinyatakan valid.
         * Selain itu return akan berisi NULL;
         */
        if (isset($data['lang']) && isset($data['word'])) {

            // Key untuk bahasa dikonversi ke bentuk lowercase, agar sesuai dengan nama tabel di Database.
            $lang = strtolower($data['lang']) . '_kosa';

            if ($lang === 'sunda_kosa' || $lang === 'indonesia_kosa') {

                // Query ke database.
                $this->db->query("SELECT $lang FROM vocabulary WHERE $lang LIKE :word;");
                $this->db->bind('word', "{$data['word']}%");

                /*
                 * Data dari database ( yang berisi list kosakata ) diubah kedalam bentuk JSON agar
                 * dapat dibaca oleh JavaScript disisi client.
                 */

                $result = $this->toJson($this->db->fetchAll(PDO::FETCH_NUM));

                // Kembalikan data.
                return '{"response" : ' . $result . '}';
            }
        }

        // Jika permintaan data yang dikirim dari client tidak valid, maka kembalikan respon NULL.
        else {
            return '{"response" : { NULL }';
        }
    }


    public function getVocabularyMean()
    {
        if (isset($_POST['lang']) && isset($_POST['kata'])) {

            $lang = strtolower($_POST['lang']) . '_kosa';

            if ($lang === 'indonesia_kosa' || $lang === 'sunda_kosa') {

                if ($lang === 'indonesia_kosa') {
                    $target_lang = 'sunda_kosa';
                } else {
                    $target_lang = 'indonesia_kosa';
                }

                $this->db->query("SELECT $target_lang FROM vocabulary WHERE $lang = :kata;");
                $this->db->bind('kata', $_POST['kata']);
                $arti_kata = $this->db->fetchAll(PDO::FETCH_NUM);

                // if ($arti_kata)
                if (!empty($arti_kata)) {
                    $arti_kata = $this->toJson($arti_kata);
                    return '{ "response" : ' . $arti_kata . ' } ';
                } else {
                    return '{ "response" : "NULL" }';
                }
            }
        }
    }


    /*
     * Fungsi untuk mengkonversi array kedalam JSON.
     * [NOTE] : Disini tidak digunakan fungsi builtin json_encode() karena jika data yang didapat terlalu besar,
     * hasilnya false dan data tidak dapat dikonversi.
     */
    public function toJson($array)
    {
        /*
         * Fungsi rekursif untuk menggenerate Array bagian dalam kedalam JSON.
         * 
         * Setiap Array hasil setiap baris tabel di database dikeluarkan sehingga menjadi
         * isi elemen induk saat ini bukan array melainkan elemen array assosiatif.
         * Sehingga hasil akhir dari Fungsi tidak lagi mengembalikan JSON didalam JSON.
         */
        function generateJson($array)
        {
            // Jika argumen bukan berupa Array, keluarkan Error.
            if (!is_array($array)) {
                throw new Error('Input harus berupa array!');
            }

            $array_length = count($array);
            $counter = 1;

            $json_data = '';

            // Statemen utama untuk generate JSON.
            foreach ($array as $key => $val) {

                if (is_array($val)) {
                    $json_data .= '"' . $key . '" :';
                    $json_data .= generateJson($val);
                } else {
                    $json_data .= '"' . $val . '"';
                }

                if ($counter < $array_length) {
                    $json_data .= ',';
                }

                $counter++;
            }

            return $json_data;
        }

        // Kembalian sudah berupa JSON.
        return '{' . generateJson($array) . '}';
    }
}
