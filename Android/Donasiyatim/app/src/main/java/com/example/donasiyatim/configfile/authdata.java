package com.example.donasiyatim.configfile;

import android.content.Context;
import android.content.SharedPreferences;

public class authdata {
    private static authdata mInstance;
    public static Context mCtx;
    public static final String SHARED_PREF_NAME = "sharedonasi";
    private static final String sudahlogin = "n";

    private static final String level = "level";
    private static final String kode_user = "kode_user";
    private static final String nama_user = "nama_user";
    private static final String akses_data = "akses_data";
    private static final String token = "token";



    private authdata(Context context){
        mCtx = context;
    }
    public static synchronized authdata getInstance(Context context){
        if (mInstance == null){
            mInstance = new authdata(context);
        }
        return mInstance;
    }

    public boolean setdatauser(String xstatus, String xkode_user, String xnama_user, String tokennya){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();

        editor.putString(level, xstatus);
        editor.putString(kode_user, xkode_user);
        editor.putString(nama_user, xnama_user);
        editor.putString(sudahlogin, "y");
        editor.putString(token, tokennya);

        editor.apply();

        return true;
    }




    public boolean ceklogin(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        if(sharedPreferences.getString(kode_user, null)!=null){
            return true;
        }
        return false;
    }

    public boolean logout(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.clear();
        editor.apply();
        return true;
    }

    public String getToken() {
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);

        return sharedPreferences.getString(token, null);
    }
    public String getAksesData() {
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);

        return sharedPreferences.getString(akses_data, null);
    }
    public String getLevel(){
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);
        return sharedPreferences.getString(level, null);
    }
    public String getKodeUser() {
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);

        return sharedPreferences.getString(kode_user, null);
    }
    public String getNamaUser() {
        SharedPreferences sharedPreferences = mCtx.getSharedPreferences(SHARED_PREF_NAME, Context.MODE_PRIVATE);

        return sharedPreferences.getString(nama_user, null);
    }
}
