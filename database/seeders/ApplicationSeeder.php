<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Seeder;

class ApplicationSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $save              = new Application();
        $save->name        = "Photofont";
        $save->description = "Photofont fotoğraf düzenleyici, tasarım yeteneğine ve bilgisine ihtiyaç duymadan, fotoğraf ve resimlerinizi harika tasarımlara dönüştürmenizi sağlayan kullanışlı ve eğlenceli bir uygulamadır.";
        $save->save();

        $save              = new Application();
        $save->name        = "Huzur Verici Sesler";
        $save->description = "Çok yoğun geçen bir günün ardından kafanızı boşaltmak, uykunuzu düzene sokmak ya da günlük hayatınıza huzur ve mutluluk mu getirmek istiyorsunuz?";
        $save->save();

        $save              = new Application();
        $save->name        = "iPaint - Boyama Kitabı";
        $save->description = "Harika bir eğlenceye hazır mısın? İşte karşınızda harika boyama kitabı: iPaint.";
        $save->save();

        $save              = new Application();
        $save->name        = "Appmoni: Uygulama Analiz Aracı";
        $save->description = "AppMoni, uygulama mağazasında bulunan tüm uygulamaların performansını takip ve analiz etmenizi sağlayan, kullanımı oldukça kolay bir izleme aracıdır.";
        $save->save();
    }
}
