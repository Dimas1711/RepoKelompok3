package com.example.donasiyatim;

public class ModelData {
    private String Tujuan;
    private String Judul;
    private String Image;
    private String ID_Kasus;

    public String getTujuan() {
        return Tujuan;
    }

    public void setTujuan(String tujuan) {
        Tujuan = tujuan;
    }

    public String getJudul() {
        return Judul;
    }

    public void setJudul(String judul) {
        Judul = judul;
    }

    public String getImage() {
        return Image;
    }

    public void setImage(String image) {
        Image = image;
    }

    public String getID_Kasus() {
        return ID_Kasus;
    }

    public void setID_Kasus(String ID_Kasus) {
        this.ID_Kasus = ID_Kasus;
    }
}
