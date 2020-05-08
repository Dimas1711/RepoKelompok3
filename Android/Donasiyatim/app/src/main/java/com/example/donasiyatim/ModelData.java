package com.example.donasiyatim;

public class ModelData {
    private String Tujuan;
    private String Judul;
    private String Image;
    private String ID_Kasus;
    private String ID_Panti;


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

    public String getID_Panti() {
        return ID_Panti;
    }

    public void setID_Panti(String ID_Panti) {
        this.ID_Panti = ID_Panti;
    }

}
