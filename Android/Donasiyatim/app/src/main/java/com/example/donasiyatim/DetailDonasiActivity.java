package com.example.donasiyatim;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.content.ContextCompat;

import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.donasiyatim.configfile.ServerApi;
import com.example.donasiyatim.configfile.Util;
import com.example.donasiyatim.configfile.authdata;
import com.google.android.material.bottomsheet.BottomSheetDialog;
import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class DetailDonasiActivity extends AppCompatActivity {

    TextView uang_terkumpul, tujuan_dana, deskripsi, tanggal, judul, nama_panti, tenggat_waktu, isi;
    ImageView imgView, imgPanti;
    Button donasiSekarang, btn_donasi;
    String id_kasus, id_user, id_regis, saldo;
    Integer uangAkun;
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
        id_kasus = getIntent().getStringExtra("id_kasus");
        id_regis = authdata.getInstance(getApplicationContext()).getKodeUser();

        donasiSekarang.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                uangAkun = Integer.parseInt(saldo);

                final BottomSheetDialog bottomSheetDialog = new BottomSheetDialog(DetailDonasiActivity.this, R.style.BottomSheet);
                View bottomSheet = LayoutInflater.from(getApplicationContext())
                        .inflate(R.layout.activity_proses_donasi, (LinearLayout) findViewById(R.id.BottomSheetDial));

                isi = bottomSheet.findViewById(R.id.uang_e_donasi);

                Log.e("saldo",""+isi);
                Log.e("saldo", ""+uangAkun);

                bottomSheet.findViewById(R.id.btn_isidonasi).setOnClickListener(new View.OnClickListener() {

                    @Override
                    public void onClick(View view) {
                        if (isi.getText().toString().equals(""))
                        {
                            Toast.makeText(DetailDonasiActivity.this, "Silahkan isi jumlah donasi", Toast.LENGTH_SHORT).show();
                        }
                        else if (Integer.parseInt(isi.getText().toString()) > uangAkun)
                        {
                            Toast.makeText(DetailDonasiActivity.this, "Saldo Tidak Cukup", Toast.LENGTH_SHORT).show();
                        }
                        else
                        {
                            loaddonasi();
                        }
                    }
                });
                bottomSheetDialog.setContentView(bottomSheet);
                bottomSheetDialog.show();
            }
        });

        loaduser();
        loaddetail();
        loadPanti();

    }

    private void loaddonasi()//ini buat nampilin saldo
    {
        StringRequest senddata = new StringRequest(Request.Method.POST, ServerApi.IPServer + "Donasi/index_post",
                new Response.Listener<String>(){

                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject res = new JSONObject(response);
                            if (res.optString("status").equals("true")) {
                                Toast.makeText(DetailDonasiActivity.this, res.getString("pesan"), Toast.LENGTH_SHORT).show();
                                Intent intent = new Intent(DetailDonasiActivity.this, MainActivity.class);
                                startActivity(intent);
                            }
                        } catch (JSONException e) {
                            e.printStackTrace();
                        }


                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Log.d("volley", "errornya : " + error.getMessage());
                    }
                }) {
            protected Map<String, String> getParams(){
                Map<String , String> params = new HashMap<>();
                params.put("id_user" , id_user);
                params.put("id_kasus" , id_kasus);
                params.put("jumlah_donasi" , isi.getText().toString());

                Log.e("erronya ",""+id_user);
                Log.e("erronya ",""+id_kasus);

                return params;
            }

        };
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(senddata);
    }



    private void loaddetail()
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "kasus/index_post?id_kasus="+id_kasus, new Response.Listener<String>(){
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

    private void loaduser()//ini buat nampilin saldo
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "data_user/index_get?id_registrasi="
                +authdata.getInstance(getApplicationContext()).getKodeUser(), new Response.Listener<String>(){
            @Override
            public void onResponse(String response) {
                JSONObject res = null;
                try {
                    res = new JSONObject(response);
                    Log.e("responnya ",""+response);
                    JSONArray arr = res.getJSONArray("data");
                    JSONObject arr1 = arr.getJSONObject(0);
                    id_user = arr1.getString("id_user");
                    saldo = arr1.getString("finansial");
                    Log.e("saldo", ""+saldo);

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
