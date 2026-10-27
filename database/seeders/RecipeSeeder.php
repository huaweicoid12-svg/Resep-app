<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;

class RecipeSeeder extends Seeder
{
    /** Hanya mengisi data awal jika tabel masih kosong, jadi aman dijalankan tiap container start. */
    public function run(): void
    {
        if (Recipe::query()->exists()) {
            return;
        }

        $recipes = [
            [
                'name' => 'Nasi Goreng Kampung',
                'country' => 'Indonesia',
                'ingredients' => "2 piring nasi putih dingin\n3 siung bawang putih\n4 siung bawang merah\n3 buah cabai rawit\n1 sdm kecap manis\n1 butir telur\n1 sdt garam\nMinyak goreng secukupnya",
                'instructions' => "Haluskan bawang putih, bawang merah, dan cabai.\nTumis bumbu halus hingga harum.\nMasukkan telur, orak-arik hingga setengah matang.\nTambahkan nasi, kecap manis, dan garam, aduk rata dengan api besar.\nAngkat dan sajikan dengan kerupuk dan acar.",
            ],
            [
                'name' => 'Rendang Daging Sapi',
                'country' => 'Indonesia',
                'ingredients' => "1 kg daging sapi, potong kotak\n800 ml santan kental\n6 siung bawang merah\n4 siung bawang putih\n5 buah cabai merah\n2 batang serai, memarkan\n3 lembar daun jeruk\n1 ruas lengkuas, memarkan\n2 sdt garam",
                'instructions' => "Haluskan bawang merah, bawang putih, dan cabai merah.\nTumis bumbu halus bersama serai, daun jeruk, dan lengkuas.\nMasukkan daging dan santan, aduk sesekali.\nMasak dengan api kecil 3 sampai 4 jam hingga santan menyusut dan bumbu mengering.\nSajikan hangat dengan nasi putih.",
            ],
            [
                'name' => 'Spaghetti Carbonara',
                'country' => 'Italia',
                'ingredients' => "200 g spaghetti\n100 g pancetta atau bacon\n2 butir kuning telur\n1 butir telur utuh\n50 g keju Pecorino atau Parmesan parut\nLada hitam secukupnya\nGaram untuk merebus",
                'instructions' => "Rebus spaghetti dalam air bergaram hingga al dente.\nGoreng pancetta hingga renyah tanpa tambahan minyak.\nKocok telur dengan keju dan lada hitam.\nCampur spaghetti panas dengan pancetta, matikan api, lalu tuang campuran telur sambil diaduk cepat.\nTambahkan sedikit air rebusan jika terlalu kental.",
            ],
            [
                'name' => 'Pad Thai',
                'country' => 'Thailand',
                'ingredients' => "150 g mi beras\n150 g udang\n2 butir telur\n3 sdm saus asam jawa\n2 sdm saus ikan\n1 sdm gula palem\n100 g tauge\n2 sdm kacang tanah cincang\n1 buah jeruk nipis",
                'instructions' => "Rendam mi beras dalam air hangat hingga lentur.\nTumis udang hingga berubah warna, sisihkan.\nOrak-arik telur, masukkan mi, saus asam jawa, saus ikan, dan gula.\nMasukkan udang dan tauge, aduk sebentar.\nSajikan dengan kacang tanah dan perasan jeruk nipis.",
            ],
            [
                'name' => 'Chicken Tikka Masala',
                'country' => 'India',
                'ingredients' => "500 g dada ayam\n150 g yoghurt\n2 sdm garam masala\n1 sdt kunyit bubuk\n3 siung bawang putih\n1 ruas jahe\n400 g tomat cincang\n150 ml krim kental\nGaram secukupnya",
                'instructions' => "Marinasi ayam dengan yoghurt, setengah garam masala, kunyit, dan garam selama 1 jam.\nPanggang atau tumis ayam hingga kecokelatan.\nTumis bawang putih dan jahe, tambahkan tomat dan sisa garam masala.\nMasukkan ayam dan krim, masak 10 menit dengan api kecil.\nSajikan dengan nasi basmati atau roti naan.",
            ],
            [
                'name' => 'Sushi Maki Salmon',
                'country' => 'Jepang',
                'ingredients' => "2 cangkir nasi sushi\n3 sdm cuka beras\n1 sdm gula\n1 sdt garam\n4 lembar nori\n200 g salmon segar\n1 buah timun\n1 buah alpukat",
                'instructions' => "Campur cuka beras, gula, dan garam, aduk ke dalam nasi hangat lalu dinginkan.\nLetakkan nori di atas tikar bambu dan ratakan nasi.\nTata salmon, timun, dan alpukat di tengah.\nGulung rapat dengan bantuan tikar bambu.\nPotong menjadi 8 bagian dengan pisau tajam yang dibasahi.",
            ],
        ];

        foreach ($recipes as $recipe) {
            Recipe::create($recipe);
        }
    }
}
