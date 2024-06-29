<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data['color_primary'] =  array(
            "primary_100" => "#ffff7b",
            "primary_200" => "#fffc5a",
            "primary_300" => "#ffde3c",
            "primary_400" => "#ffc01e",
            "primary_500" => "#ffa200",
            "primary_600" => "#e18400",
            "primary_700" => "#c36600",
            "primary_800" => "#a54800",
            "primary_900" => "#872a00"
        );

        $data['color_secondary'] =  array(
            "secondary_100" => "#C7E1F8",
            "secondary_200" => "#91C1F2",
            "secondary_300" => "#5792DA",
            "secondary_400" => "#2D65B5",
            "secondary_500" => "#003285",
            "secondary_600" => "#002672",
            "secondary_700" => "#001C5F",
            "secondary_800" => "#00144D",
            "secondary_900" => "#000E3F"
        );

        Setting::create([
            'name' => 'Virtusee',
            'tagline' => 'Valid Data, Informatif Report, Decision-making with Virtusee AI',
            'description' => 'Virtusee dibuat untuk mengakselerasi bisnis, khususnya untuk monitoring & tracking data yang diberikan oleh tim lapangan.',
            'no_telp' => '081252936452',
            'address' => 'JL. Penjaringan Sari, YKP Pandugo 2 Blok P No. 1, Penjaringan Sari, Kec. Rungkut, Kota Surabaya, Jawa Timur. Indonesia',
            'email' => 'loremipsum@gmail.com',
            'maps_location' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.326159306427!2d112.78630901081486!3d-7.317210392660349!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb9d4cb9c9eb%3A0xb2bf40c523185ae3!2sVirtusee%20Peta%20Sukses!5e0!3m2!1sen!2sid!4v1716949051685!5m2!1sen!2sid',

            'mail_mailer' => 'smtp',
            'mail_host' => 'smtp.gmail.com',
            'mail_port' => '587',
            'mail_username' => 'noreply.unigres@gmail.com',
            'mail_password' => 'vysrvgsuhpdzpqed',
            'mail_encryption' => 'tls',
            'mail_from_addres' => 'noreply.unigres@gmail.com',
            'mail_from_name' => '"${APP_NAME}"',

            'color_primary' => json_encode($data['color_primary']),
            'color_secondary' => json_encode($data['color_secondary'])
        ]);
    }
}
