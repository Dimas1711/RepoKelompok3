package com.example.donasiyatim;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
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

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class DompetActivity extends AppCompatActivity {

    TextView saldo;
    EditText isi;
    List<ModelDataRiwayatTopup> modelDataRiwayatTopup;
    ListAdapterRiwayatTopup listAdapterRiwayatTopup;
    RecyclerView rv_riwayat;
    Button isi_saldo, btn;
    String id_user,id_regis,nama, saldoku;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dompet);

        saldo = findViewById(R.id.finansial);
        rv_riwayat = findViewById(R.id.rv_riwayatTopup);
        isi_saldo = findViewById(R.id.btn_isi);
        id_regis = getIntent().getStringExtra("id_regis");
        saldoku = getIntent().getStringExtra("saldo");
        Log.e("asd", ""+saldoku);

        loaddetail();
        retrieveJSONRiwayatTopup();

        isi_saldo.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
//                Intent intent = new Intent(DompetActivity.this, TopupActivity.class);
//                intent.putExtra("id_user",id_user);
//                intent.putExtra("id_regis",id_regis);
//                intent.putExtra("nama_user",nama);
//                startActivity(intent);

                final BottomSheetDialog bottomSheetDialog = new BottomSheetDialog(DompetActivity.this, R.style.BottomSheet);
                View bottomSheet = LayoutInflater.from(getApplicationContext())
                        .inflate(R.layout.activity_topup, (LinearLayout) findViewById(R.id.BottomSheetDial));

                isi = bottomSheet.findViewById(R.id.uang_e);

                bottomSheet.findViewById(R.id.rp50).setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        isi.setText("50000");
                    }
                });
                bottomSheet.findViewById(R.id.rp100).setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        isi.setText("100000");
                    }
                });
                bottomSheet.findViewById(R.id.rp150).setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        isi.setText("150000");
                    }
                });
                bottomSheet.findViewById(R.id.rp200).setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        isi.setText("200000");
                    }
                });

                bottomSheet.findViewById(R.id.btn_isisaldo).setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        if (isi.getText().toString().equals(""))
                        {
                            Toast.makeText(DompetActivity.this, "Silahkan pilih jumlah top up", Toast.LENGTH_SHORT).show();
                        }
                        else
                        {
                            Intent intent = new Intent(DompetActivity.this, UploadFotoActivity.class);
                            intent.putExtra("jumlah_inginkan", isi.getText().toString());
                            Log.e("uang", "" + intent.putExtra("jumlah_inginkan", isi.getText().toString()));
                            intent.putExtra("id_user", id_user);
                            intent.putExtra("nama_user", nama);
                            startActivity(intent);
                        }
                    }
                });
                bottomSheetDialog.setContentView(bottomSheet);
                bottomSheetDialog.show();
            }
        });

    }
    private void loaddetail()//ini buat nampilin saldo
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "data_user/index_get?id_registrasi="+id_regis,
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
                    nama = arr1.getString("nama_user");
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
