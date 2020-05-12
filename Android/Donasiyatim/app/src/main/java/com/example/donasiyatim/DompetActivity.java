package com.example.donasiyatim;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
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

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class DompetActivity extends AppCompatActivity {

    TextView saldo;
    List<ModelDataRiwayatTopup> modelDataRiwayatTopup;
    ListAdapterRiwayatTopup listAdapterRiwayatTopup;
    RecyclerView rv_riwayat;
    Button isi_saldo;
    String id_user;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dompet);

        saldo = findViewById(R.id.finansial);
        rv_riwayat = findViewById(R.id.rv_riwayatTopup);
        isi_saldo = findViewById(R.id.btn_isi);

        loaddetail();
        retrieveJSONRiwayatTopup();

        isi_saldo.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(DompetActivity.this, TopupActivity.class);
                intent.putExtra("id_user",id_user);
                startActivity(intent);
            }
        });

    }

    private void loaddetail()//ini buat nampilin saldo
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "data_user/index_get?id_registrasi="+getIntent().getStringExtra("id_regis"),
                new Response.Listener<String>(){
            @Override
            public void onResponse(String response) {
                JSONObject res = null;
                try {
                    res = new JSONObject(response);
                    Log.e("responnya ",""+response);
                    JSONArray arr = res.getJSONArray("data");
                    JSONObject arr1 = arr.getJSONObject(0);
                    saldo.setText(Util.setformatrupiah(arr1.getString("finansial")));
                    id_user = arr1.getString("id_user");
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

    private void retrieveJSONRiwayatTopup()
    {
        StringRequest stringRequest  = new StringRequest(Request.Method.GET, ServerApi.IPServer + "Riwayat_topup/index_get?id_user="+getIntent().getStringExtra("id_user"),
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String responseRiwayat) {
                        Log.d("strrrrr", ">>" + responseRiwayat);
                        try {
                            JSONObject obj  = new JSONObject(responseRiwayat);

                            modelDataRiwayatTopup = new ArrayList<>();
                            JSONArray data = obj.getJSONArray("data");
                            for (int i = 0; i < data.length(); i++)
                            {
                                ModelDataRiwayatTopup playerModel = new ModelDataRiwayatTopup();
                                JSONObject dataobj = data.getJSONObject(i);
                                playerModel.setJumlah_uang("+ "+Util.setformatrupiah(dataobj.getString("jumlah_inginkan")));
                                playerModel.setTanggal_topup(Util.settanggal(dataobj.getString("tanggal")));

                                modelDataRiwayatTopup.add(playerModel);
                            }
                            setupListRiwayatTopup();

                        }
                        catch (JSONException e)
                        {
                            e.printStackTrace();
                        }
                    }
                },
                new Response.ErrorListener()
                {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        Log.d("volley", "errornya : " + error.getMessage());
                    }
                });

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }

    private void setupListRiwayatTopup()
    {
        listAdapterRiwayatTopup = new ListAdapterRiwayatTopup(this, modelDataRiwayatTopup);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(this);
        rv_riwayat.setLayoutManager(layoutManager);
        rv_riwayat.setAdapter(listAdapterRiwayatTopup);
    }

}
