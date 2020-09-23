package com.example.donasiyatim.detail;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.util.Log;
import android.widget.ImageView;
import android.widget.TextView;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.donasiyatim.R;
import com.example.donasiyatim.configfile.ServerApi;
import com.example.donasiyatim.configfile.Util;
import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class DetailBeritaActivity extends AppCompatActivity {
    TextView judul_berita, isi_berita, tanggal_berita;
    ImageView img_berita;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detail_berita);
        judul_berita = findViewById(R.id.tv_judul_berita_detail);
        isi_berita = findViewById(R.id.tv_isi_berita_detail);
        tanggal_berita = findViewById(R.id.tv_tanggal_berita_detail);
        img_berita = findViewById(R.id.img_berita_detail);
        loadBerita();
    }

    private void loadBerita()
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "berita/index_get?id_berita="
                +getIntent().getStringExtra("id_berita"), new Response.Listener<String>(){
            @Override
            public void onResponse(String response) {
                JSONObject res = null;
                try {
                    res = new JSONObject(response);
                    Log.e("responnya ",""+response);
                    JSONArray arr = res.getJSONArray("data");
                    JSONObject arr1 = arr.getJSONObject(0);
                    judul_berita.setText(arr1.getString("judul"));
                    isi_berita.setText(arr1.getString("isi"));
                    tanggal_berita.setText(Util.settanggal(arr1.getString("tanggal_berita")));
                    Picasso.get().load(ServerApi.IPServer + "../" + "uploads/berita/"+ arr1.getString("gambar")).into(img_berita);
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
