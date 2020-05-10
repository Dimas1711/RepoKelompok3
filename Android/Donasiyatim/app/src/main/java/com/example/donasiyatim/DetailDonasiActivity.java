package com.example.donasiyatim;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.content.ContextCompat;

import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.util.Log;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.donasiyatim.configfile.ServerApi;
import com.example.donasiyatim.configfile.Util;
import com.example.donasiyatim.configfile.authdata;
import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class DetailDonasiActivity extends AppCompatActivity {

    TextView uang_terkumpul, tujuan_dana, deskripsi, tanggal, judul, nama_panti, tenggat_waktu;
    ImageView imgView, imgPanti;
    Button donasiSekarang;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_donasi);

        uang_terkumpul = findViewById(R.id.tv_jumlah_uang_terkumpul);
        tujuan_dana = findViewById(R.id.tv_tujuan_dana_detail);
        deskripsi = findViewById(R.id.deskripsi);
        imgView = findViewById(R.id.img_kasus_detail);
        tanggal = findViewById(R.id.tv_tanggal);
        judul = findViewById(R.id.tv_judul_detail);
        nama_panti = findViewById(R.id.nama_panti);
        tenggat_waktu = findViewById(R.id.tv_tenggat_waktu);
        imgPanti = findViewById(R.id.img_panti);
        donasiSekarang = findViewById(R.id.btn_donasi);



        loaddetail();
        loadPanti();

    }

    private void loaddetail()
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "kasus/index_post?id_kasus="+getIntent().getStringExtra("id_kasus"), new Response.Listener<String>(){
            @Override
            public void onResponse(String response) {
                JSONObject res = null;
                try {
                    res = new JSONObject(response);
                    Log.e("responnya ",""+response);
                    JSONArray arr = res.getJSONArray("data");
                    JSONObject arr1 = arr.getJSONObject(0);
                    uang_terkumpul.setText(Util.setformatrupiah(arr1.getString("jumlah_uang_terkumpul")));
                    tujuan_dana.setText(Util.setformatrupiah(arr1.getString("tujuan_dana")));
                    deskripsi.setText(arr1.getString("deskripsi"));
                    tanggal.setText(Util.settanggal(arr1.getString("tanggal")));
                    tenggat_waktu.setText(Util.settanggal(arr1.getString("tenggat_waktu")));
                    judul.setText(arr1.getString("judul"));
                    Picasso.get().load(ServerApi.IPServer + "../"+ "uploads/panti/" +arr1.getString("gambar")).into(imgView);
                    if (arr1.getString("is_active").equals("0"))
                    {
                        donasiSekarang.setEnabled(false);
                        donasiSekarang.setText("Donasi Telah Selesai");
                        donasiSekarang.setBackgroundResource(R.drawable.btn_donasi_selesai);
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                    Log.e("erronya ",""+e);
                }
            }
        },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Log.d("volley", "errornya : " + error.getMessage());
                    }
                }) {

        };
        RequestQueue requestQueue = Volley.newRequestQueue(this);

        requestQueue.add(senddata);
    }

    private void loadPanti()
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "panti/index_get?id_panti="+getIntent().getStringExtra("id_panti"), new Response.Listener<String>(){
            @Override
            public void onResponse(String response) {
                JSONObject res = null;
                try {
                    res = new JSONObject(response);
                    Log.e("responnya ",""+response);
                    JSONArray arr = res.getJSONArray("data");
                    JSONObject arr1 = arr.getJSONObject(0);
                    nama_panti.setText(arr1.getString("nama_panti"));
                    Picasso.get().load(ServerApi.IPServer + "../" + "uploads/panti/"+ arr1.getString("foto")).into(imgPanti);
                } catch (JSONException e) {
                    e.printStackTrace();
                    Log.e("erronya ",""+e);
                }
            }
        },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Log.d("volley", "errornya : " + error.getMessage());
                    }
                }) {

        };
        RequestQueue requestQueue = Volley.newRequestQueue(this);

        requestQueue.add(senddata);
    }

}
