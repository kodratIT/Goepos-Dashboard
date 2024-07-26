<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankShortCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            ['bank_name' => 'Bank Central Asia (BCA)', 'short_code' => 'BCA'],
            ['bank_name' => 'Bank Syariah Mandiri', 'short_code' => 'MANDIRI_SYR'],
            ['bank_name' => 'Bank Mandiri', 'short_code' => 'MANDIRI'],
            ['bank_name' => 'Bank Rakyat Indonesia', 'short_code' => 'BRI'],
            ['bank_name' => 'Bank Kesejahteraan Ekonomi / Seabank', 'short_code' => 'KESEJAHTERAAN_EKONOMI'],
            ['bank_name' => 'Bank Negara Indonesia', 'short_code' => 'BNI'],
            ['bank_name' => 'Bank Yudha Bhakti / Neo Commerce', 'short_code' => 'YUDHA_BHAKTI'],
            ['bank_name' => 'Bank Artos Indonesia / Bank Jago', 'short_code' => 'ARTOS'],
            ['bank_name' => 'Bank BJB', 'short_code' => 'BJB'],
            ['bank_name' => 'Bank Tabungan Negara (BTN)', 'short_code' => 'BTN'],
            ['bank_name' => 'Bank Permata', 'short_code' => 'PERMATA'],
            ['bank_name' => 'BPD Jawa Tengah', 'short_code' => 'JAWA_TENGAH'],
            ['bank_name' => 'Bank UOB Indonesia', 'short_code' => 'UOB'],
            ['bank_name' => 'CIMB Niaga Bank', 'short_code' => 'CIMB_NIAGA'],
            ['bank_name' => 'BPD Sumsel Dan Babel', 'short_code' => 'SUMSEL_DAN_BABEL'],
            ['bank_name' => 'Bank Royal Indonesia', 'short_code' => 'ROYAL'],
            ['bank_name' => 'Bank Hana', 'short_code' => 'HANA'],
            ['bank_name' => 'BSI (Bank Syariah Indonesia) / Mandiri Syariah', 'short_code' => 'BSI'],
            ['bank_name' => 'Sinarmas', 'short_code' => 'SINARMAS'],
            ['bank_name' => 'Standard Charted Bank', 'short_code' => 'STANDARD_CHARTERED'],
            ['bank_name' => 'BPD Sulut', 'short_code' => 'SULUT'],
            ['bank_name' => 'Bank Tabungan Pensiunan Nasional', 'short_code' => 'TABUNGAN_PENSIUNAN_NASIONAL'],
            ['bank_name' => 'Bank Panin', 'short_code' => 'PANIN'],
            ['bank_name' => 'BPD Jawa Timur', 'short_code' => 'JAWA_TIMUR'],
            ['bank_name' => 'Bank OCBC NISP', 'short_code' => 'OCBC'],
            ['bank_name' => 'Bank Muamalat Indonesia', 'short_code' => 'MUAMALAT'],
            ['bank_name' => 'BPD Sumatera Barat', 'short_code' => 'SUMATERA_BARAT'],
            ['bank_name' => 'Bank DKI', 'short_code' => 'DKI'],
            ['bank_name' => 'Bank Maybank', 'short_code' => 'BII'],
            ['bank_name' => 'BPD Kalimantan Timur', 'short_code' => 'KALIMANTAN_TIMUR'],
            ['bank_name' => 'Bank Danamon', 'short_code' => 'DANAMON'],
            ['bank_name' => 'Bank Nationalnobu', 'short_code' => 'NATIONALNOBU'],
            ['bank_name' => 'BPD Riau Dan Kepri', 'short_code' => 'RIAU_DAN_KEPRI'],
            ['bank_name' => 'Bank DBS Indonesia', 'short_code' => 'DBS'],
            ['bank_name' => 'Bank Harda Internasional', 'short_code' => 'HARDA_INTERNASIONAL'],
            ['bank_name' => 'BPD Papua', 'short_code' => 'PAPUA'],
            ['bank_name' => 'Bank CIMB Niaga UUS', 'short_code' => 'CIMB_UUS'],
            ['bank_name' => 'BPD Kalimantan Barat', 'short_code' => 'KALIMANTAN_BARAT'],
            ['bank_name' => 'BPD Sulawesi Tenggara', 'short_code' => 'SULAWESI_TENGGARA'],
            ['bank_name' => 'Bank Commonwealth', 'short_code' => 'COMMONWEALTH'],
            ['bank_name' => 'BPD Sumut', 'short_code' => 'SUMUT'],
            ['bank_name' => 'BPD Sulawesi Tengah', 'short_code' => 'SULAWESI'],
            ['bank_name' => 'Hongkong and Shanghai Bank Corporation (HSBC) UUS', 'short_code' => 'HSBC_UUS'],
            ['bank_name' => 'Bank Artha Graha International', 'short_code' => 'ARTHA'],
            ['bank_name' => 'BPD Jambi', 'short_code' => 'JAMBI'],
            ['bank_name' => 'BPD Sulselbar', 'short_code' => 'SULSELBAR'],
            ['bank_name' => 'BPD Kalimantan Timur UUS', 'short_code' => 'KALIMANTAN_TIMUR_UUS'],
            ['bank_name' => 'BPD Aceh', 'short_code' => 'ACEH'],
            ['bank_name' => 'BPD Aceh UUS', 'short_code' => 'ACEH_UUS'],
            ['bank_name' => 'BPD Bali', 'short_code' => 'BALI'],
            ['bank_name' => 'BPD Kalimantan Selatan', 'short_code' => 'KALIMANTAN_SELATAN'],
            ['bank_name' => 'Bank Central Asia (BCA) Syariah', 'short_code' => 'BCA_SYR'],
            ['bank_name' => 'Bank Mega', 'short_code' => 'MEGA'],
            ['bank_name' => 'BPD Nusa Tenggara Timur', 'short_code' => 'NUSA_TENGGARA_TIMUR'],
            ['bank_name' => 'BPD Sumatera Barat UUS', 'short_code' => 'SUMATERA_BARAT_UUS'],
            ['bank_name' => 'Bank Pembangunan Daerah (BPD DIY)', 'short_code' => 'BPD_DIY'],
            ['bank_name' => 'Bank Agroniaga', 'short_code' => 'AGRONIAGA'],
            ['bank_name' => 'Bank Bukopin', 'short_code' => 'BUKOPIN'],
            ['bank_name' => 'Bank Danamon UUS', 'short_code' => 'DANAMON_UUS'],
            ['bank_name' => 'Bank MNC Internasional', 'short_code' => 'MNC_INTERNASIONAL'],
            ['bank_name' => 'Citibank', 'short_code' => 'CITIBANK'],
            ['bank_name' => 'BPD Lampung', 'short_code' => 'LAMPUNG'],
            ['bank_name' => 'BPD Nusa Tenggara Barat', 'short_code' => 'NUSA_TENGGARA_BARAT'],
            ['bank_name' => 'Bank Tabungan Pensiunan Nasional UUS', 'short_code' => 'TABUNGAN_PENSIUNAN_NASIONAL_UUS'],
            ['bank_name' => 'BPD Kalimantan Tengah', 'short_code' => 'KALIMANTAN_TENGAH'],
            ['bank_name' => 'BPD Nusa Tenggara Barat UUS', 'short_code' => 'NUSA_TENGGARA_BARAT_UUS'],
            ['bank_name' => 'Bank BJB Syariah', 'short_code' => 'BJB_SYR'],
            ['bank_name' => 'Bank OCBC NISP UUS', 'short_code' => 'OCBC_UUS'],
            ['bank_name' => 'BPD Sumsel Dan Babel UUS', 'short_code' => 'SUMSEL_DAN_BABEL_UUS'],
            ['bank_name' => 'Bank Panin Syariah', 'short_code' => 'PANIN_SYR'],
            ['bank_name' => 'Bank Sahabat Sampoerna', 'short_code' => 'SAHABAT_SAMPOERNA'],
            ['bank_name' => 'Bank Multi Arta Sentosa', 'short_code' => 'MULTI_ARTA_SENTOSA'],
            ['bank_name' => 'Bank Himpunan Saudara 1906', 'short_code' => 'HIMPUNAN_SAUDARA'],
            ['bank_name' => 'Bank Syariah Mega', 'short_code' => 'MEGA_SYR'],
            ['bank_name' => 'Hongkong and Shanghai Bank Corporation (HSBC)', 'short_code' => 'HSBC'],
            ['bank_name' => 'Bank Permata UUS', 'short_code' => 'PERMATA_UUS'],
            ['bank_name' => 'Bank Ganesha', 'short_code' => 'GANESHA'],
            ['bank_name' => 'Bank Woori Indonesia / Himpunan Saudara', 'short_code' => 'WOORI'],
            ['bank_name' => 'Bank Mayapada International', 'short_code' => 'MAYAPADA'],
            ['bank_name' => 'Bank Mayora', 'short_code' => 'MAYORA'],
            ['bank_name' => 'Bank Metro Express', 'short_code' => 'METRO_EXPRESS'],
            ['bank_name' => 'BPD Jambi UUS', 'short_code' => 'JAMBI_UUS'],
            ['bank_name' => 'BPD Jawa Tengah UUS', 'short_code' => 'JAWA_TENGAH_UUS'],
            ['bank_name' => 'Bank Maybank Syariah Indonesia', 'short_code' => 'MAYBANK_SYR'],
            ['bank_name' => 'Bank Tabungan Negara (BTN) UUS', 'short_code' => 'BTN_UUS'],
            ['bank_name' => 'Bank DKI UUS', 'short_code' => 'DKI_UUS'],
            ['bank_name' => 'BPD Kalimantan Selatan UUS', 'short_code' => 'KALIMANTAN_SELATAN_UUS'],
            ['bank_name' => 'Bank Agris', 'short_code' => 'AGRIS'],
            ['bank_name' => 'Bank Antar Daerah', 'short_code' => 'ANTAR_DAERAH'],
            ['bank_name' => 'Bank ANZ Indonesia', 'short_code' => 'ANZ'],
            ['bank_name' => 'Anglomas International Bank', 'short_code' => 'ANGLOMAS'],
            ['bank_name' => 'Bank QNB Kesawan', 'short_code' => 'QNB_KESAWAN'],
            ['bank_name' => 'Bank Bumi Arta', 'short_code' => 'BUMI_ARTA'],
            ['bank_name' => 'Bank Andara', 'short_code' => 'ANDARA'],
            ['bank_name' => 'Bank Capital Indonesia', 'short_code' => 'CAPITAL'],
            ['bank_name' => 'Bank Chinatrust Indonesia', 'short_code' => 'CHINATRUST'],
            ['bank_name' => 'Bank Index Selindo', 'short_code' => 'INDEX_SELINDO'],
            ['bank_name' => 'Bank of China (BOC)', 'short_code' => 'BOC'],
            ['bank_name' => 'Bangkok Bank', 'short_code' => 'BANGKOK'],
            ['bank_name' => 'Bank Mestika Dharma', 'short_code' => 'MESTIKA_DHARMA'],
            ['bank_name' => 'Bank Ekonomi Raharja', 'short_code' => 'EKONOMI_RAHARJA'],
            ['bank_name' => 'Bank BNP Paribas', 'short_code' => 'BNP'],
            ['bank_name' => 'Bank Resona Perdania', 'short_code' => 'RESONA'],
            ['bank_name' => 'Bank Bisnis Internasional', 'short_code' => 'BISNIS'],
            ['bank_name' => 'Bank Victoria Internasional', 'short_code' => 'VICTORIA_INTERNASIONAL'],
            ['bank_name' => 'Bank Mutiara / Jtrust', 'short_code' => 'MUTIARA'],
            ['bank_name' => 'Centratama Nasional Bank', 'short_code' => 'CENTRATAMA'],
            ['bank_name' => 'BANK CTBC INDO', 'short_code' => 'CTBC'],
            ['bank_name' => 'Deutsche Bank', 'short_code' => 'DEUTSCHE'],
            ['bank_name' => 'Bank of America Merill-Lynch', 'short_code' => 'BAML'],
            ['bank_name' => 'Bank Pundi Indonesia', 'short_code' => 'PUNDI_INDONESIA'],
            ['bank_name' => 'Bank of Tokyo Mitsubishi UFJ', 'short_code' => 'TOKYO'],
            ['bank_name' => 'Bank Fama International', 'short_code' => 'FAMA'],
            ['bank_name' => 'Bank Sahabat Purba Danarta', 'short_code' => 'SAHABAT_PURBA_DANARTA'],
            ['bank_name' => 'Bank ICBC Indonesia', 'short_code' => 'ICBC'],
            ['bank_name' => 'Bank Syariah BRI', 'short_code' => 'BRI_SYR'],
            ['bank_name' => 'Bank Ina Perdana', 'short_code' => 'INA_PERDANA'],
            ['bank_name' => 'Bank Jasa Jakarta', 'short_code' => 'JASA_JAKARTA'],
            ['bank_name' => 'Bank Dinar Indonesia', 'short_code' => 'DINAR_INDONESIA'],
            ['bank_name' => 'Bank Maspion Indonesia', 'short_code' => 'MASPION'],
            ['bank_name' => 'Bank Windu Kentjana Int', 'short_code' => 'WINDU'],
            ['bank_name' => 'Bank Mitra Niaga', 'short_code' => 'MITRA_NIAGA'],
            ['bank_name' => 'Bank Mizuho Indonesia', 'short_code' => 'MIZUHO'],
            ['bank_name' => 'Bank Nusantara Parahyangan', 'short_code' => 'NUSANTARA_PARAHYANGAN'],
            ['bank_name' => 'BPD Bengkulu', 'short_code' => 'BENGKULU'],
            ['bank_name' => 'Bank Jateng', 'short_code' => 'JATENG'],
            ['bank_name' => 'BPD Jawa Timur UUS', 'short_code' => 'JAWA_TIMUR_UUS'],
            ['bank_name' => 'BPD Maluku', 'short_code' => 'MALUKU'],
            ['bank_name' => 'Bank Rakyat Indonesia Agroniaga (Bank Raya)', 'short_code' => 'RAYA'],
            ['bank_name' => 'BPD Riau Dan Kepri UUS', 'short_code' => 'RIAU_DAN_KEPRI_UUS'],
            ['bank_name' => 'BPD Sulselbar UUS', 'short_code' => 'SULSELBAR_UUS'],
            ['bank_name' => 'Bank Pembangunan Daerah (BPD DIY) Syariah', 'short_code' => 'BPD_DIY_SYR'],
            ['bank_name' => 'Prima Master Bank', 'short_code' => 'PRIMA_MASTER'],
            ['bank_name' => 'Bank Rabobank International Indonesia', 'short_code' => 'RABOBANK'],
            ['bank_name' => 'Bank SBI Indonesia', 'short_code' => 'SBI_INDONESIA'],
            ['bank_name' => 'JP Morgan Chase Bank', 'short_code' => 'JPMORGAN'],
            ['bank_name' => 'Bank Syariah Bukopin', 'short_code' => 'BUKOPIN_SYR'],
            ['bank_name' => 'Bank Ekspor Indonesia', 'short_code' => 'EKSPOR_INDONESIA'],
            ['bank_name' => 'Bank Arta Niaga Kencana', 'short_code' => 'ARTA_NIAGA_KENCANA'],
            ['bank_name' => 'Bank Sinar Harapan Bali / Mandiri Taspen', 'short_code' => 'SINAR_HARAPAN_BALI'],
            ['bank_name' => 'Bank Sumitomo Mitsui Indonesia', 'short_code' => 'MITSUI'],
            ['bank_name' => 'Bank IBK Indonesia', 'short_code' => 'IBK'],
            ['bank_name' => 'BPD Banten', 'short_code' => 'BANTEN'],
            ['bank_name' => 'Bank Victoria Syariah', 'short_code' => 'VICTORIA_SYR'],
            ['bank_name' => 'BANK MANTAP (Mandiri Taspen)', 'short_code' => 'MANTAP'],
            ['bank_name' => 'Bank Shinhan Indonesia', 'short_code' => 'SHINHAN'],
            ['bank_name' => 'BPD Kalimantan Barat UUS', 'short_code' => 'KALIMANTAN_BARAT_UUS'],
            ['bank_name' => 'Bank BNI Syariah', 'short_code' => 'BNI_SYR'],
            ['bank_name' => 'BPD Sumut UUS', 'short_code' => 'SUMUT_UUS'],
            ['bank_name' => 'Bank Nagari', 'short_code' => 'NAGARI'],
            ['bank_name' => 'Bank of India Indonesia', 'short_code' => 'INDIA'],
            ['bank_name' => 'Bank Aladin Syariah', 'short_code' => 'ALADIN'],
            ['bank_name' => 'Bank Indonesia (KPO)', 'short_code' => 'BI'],
            ['bank_name' => 'Bank Jago Syariah', 'short_code' => 'JAGO_UUS'],
            ['bank_name' => 'Bank of America', 'short_code' => 'BOFA'],
            ['bank_name' => 'BPR Eka', 'short_code' => 'EKA'],
            ['bank_name' => 'Sinarmas Syariah', 'short_code' => 'SINARMAS_SYR'],
            ['bank_name' => 'Royal Bank Scotland', 'short_code' => 'SCOTLAND'],
            ['bank_name' => 'Kustodian Sentral Efek Indonesia', 'short_code' => 'KSEI'],
        ];

        DB::table('bank_short_code')->insert($banks);
    }
}
