package com.example.donasiyatim;

public class ModelDataBerita {

    private String Judul_berita;
    private String Isi_berita;
    private String ID_berita;
    private String Tanggal_berita;
    private String Gambar_berita;


    public String getGambar_berita() {
        return Gambar_berita;
    }

    public void setGambar_berita(String gambar_berita) {
        Gambar_berita = gambar_berita;
    }

    public String getTanggal_berita() {
        return Tanggal_berita;
    }

    public void setTanggal_berita(String tanggal_berita) {
        Tanggal_berita = tanggal_berita;
    }

    public String getID_berita() {
        return ID_berita;
    }

    public void setID_berita(String ID_berita) {
        this.ID_berita = ID_berita;
    }

    public String getIsi_berita() {
        return Isi_berita;
    }

    public void setIsi_berita(String isi_berita) {
        Isi_berita = isi_berita;
    }

    public String getJudul_berita() {
        return Judul_berita;
    }

    public void setJudul_berita(String judul_berita) {
        Judul_berita = judul_berita;
    }
}
