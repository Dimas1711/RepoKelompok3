package com.example.donasiyatim.konten;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.content.DialogInterface;
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

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.donasiyatim.R;
import com.example.donasiyatim.adapter.ListAdapterRiwayatTopup;
import com.example.donasiyatim.configfile.ServerApi;
import com.example.donasiyatim.configfile.Util;
import com.example.donasiyatim.model.ModelDataRiwayatTopup;
import com.google.android.material.bottomsheet.BottomSheetDialog;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class DompetActivity extends AppCompatActivity {

    TextView saldo, bca, bni, bri;
    EditText isi, akunbank;
    List<ModelDataRiwayatTopup> modelDataRiwayatTopup;
    ListAdapterRiwayatTopup listAdapterRiwayatTopup;
    RecyclerView rv_riwayat;
    Button isi_saldo, btn;
    View dialogview;
    String id_user,id_regis,nama, saldoku, id_akun, koded, ku;
    ArrayList<String> databank=new ArrayList<String>();
    ArrayList<String> indexdatabank=new ArrayList<String>();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_dompet);

        saldo = findViewById(R.id.finansial);
        rv_riwayat = findViewById(R.id.rv_riwayatTopup);
        isi_saldo = findViewById(R.id.btn_isi);
        id_regis = getIntent().getStringExtra("id_regis");
        saldoku = getIntent().getStringExtra("saldo");
        id_user = getIntent().getStringExtra("id_user");
        Log.e("asd", ""+saldoku);
        Log.e("asd", "id user e"+id_user);
        loaddetail();
        retrieveJSONRiwayatTopup();
        getdatabank();

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

                akunbank = bottomSheet.findViewById(R.id.textakunbank);
                isi = bottomSheet.findViewById(R.id.uang_e);
                btn = bottomSheet.findViewById(R.id.buttonakunbank);

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

                btn.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View view) {
                        AlertDialog.Builder pictureDialog = new AlertDialog.Builder(DompetActivity.this);
                        pictureDialog.setTitle("Pilih Kategori Bank");
                        pictureDialog.setItems(databank.toArray(new String[0]), new DialogInterface.OnClickListener() {
                                    @Override
                                    public void onClick(DialogInterface dialogInterface, int i) {
                                        koded = indexdatabank.get(i);
                                        Log.e("kodenya",""+koded);
                                        akunbank.setText(databank.get(i));
                                    }
                                });
                        pictureDialog.show();
                                //showDialog();
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
                            if (akunbank.getText().toString().equals(""))
                            {
                                Toast.makeText(DompetActivity.this, "Silahkan pilih akun bank", Toast.LENGTH_SHORT).show();
                            }
                            else
                            {
                                Intent intent = new Intent(DompetActivity.this, UploadFotoActivity.class);
                                intent.putExtra("jumlah_inginkan", isi.getText().toString());
                                Log.e("uang", "" + intent.putExtra("jumlah_inginkan", isi.getText().toString()));
                                intent.putExtra("id_user", id_user);
                                intent.putExtra("nama_user", nama);
                                intent.putExtra("id_akun",koded);
                                Log.e("asd","intent kode "+koded);
                                startActivity(intent);
                            }
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
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "Data_User/index_get?id_registrasi="+id_regis,
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
        StringRequest stringRequest  = new StringRequest(Request.Method.GET, ServerApi.IPServer + "Riwayat_Topup/index_get?id_user="+id_user,
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


    private void getdatabank()
    {

        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "Account_Finansial/index_get", new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                JSONObject res = null;
                try {
                    res = new JSONObject(response);
                        JSONArray arr = res.getJSONArray("data");
                        for (int i = 0; i < arr.length(); i++) {
                            try {
                                JSONObject datakom = arr.getJSONObject(i);
                                ku = datakom.getString("nama_bank");
                                koded = datakom.getString("id_akun");
                                Log.e("asd","nama bank"+ku);
                                Log.e("asd","id akun"+koded);
                                databank.add(ku);
                                indexdatabank.add(koded);
                            } catch (Exception ea) {
                                ea.printStackTrace();

                            }
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

            @Override
            public Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<String, String>();
                params.put("id_akun", koded);
                return params;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(senddata);
        //AppController.getInstance().addToRequestQueue(senddata);
    }




}
