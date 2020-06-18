package com.example.donasiyatim;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.donasiyatim.configfile.ServerApi;
import com.example.donasiyatim.configfile.authdata;
import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class ProfilActivity extends AppCompatActivity {

    Button edit;

    TextView email, nama, profil;
    ImageView fotoProfil;

    String foto, alamat,no_telp, no_rek, nama_rek, nama_bank, tanggal_lahir, jenis_kelamin, tempat_lahir, nik, pekerjaan, finansial;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profil);
        edit = findViewById(R.id.edit_profil);
        email = findViewById(R.id.text_email);
        nama = findViewById(R.id.text_nama);
        profil = findViewById(R.id.textprofil);
        fotoProfil = findViewById(R.id.profil);

        getdata();
        getFoto();


        edit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent edt = new Intent(ProfilActivity.this , EditprofilActivity.class);
                edt.putExtra("alamat", alamat);
                edt.putExtra("no_telp", no_telp);
                edt.putExtra("no_rek", no_rek);
                edt.putExtra("nama_rek", nama_rek);
                edt.putExtra("nama_bank", nama_bank);
                edt.putExtra("tanggal_lahir", tanggal_lahir);
                edt.putExtra("jenis_kelamin", jenis_kelamin);
                edt.putExtra("tempat_lahir", tempat_lahir);
                edt.putExtra("nik", nik);
                edt.putExtra("pekerjaan", pekerjaan);
                edt.putExtra("finansial", finansial);
                startActivity(edt);
            }
        });
    }

    private void getdata()
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer+"data_user/index_get?id_registrasi="
                + authdata.getInstance(ProfilActivity.this).getKodeUser(), new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
//                pd.cancel();
                JSONObject res = null;
                try {

                    res = new JSONObject(response);
                    Log.e("responnya ",""+response);
                    JSONArray arr = res.getJSONArray("data");
                    JSONObject arr1 = arr.getJSONObject(0);
                    email.setText(arr1.getString("email"));
                    nama.setText(arr1.getString("nama_user"));
                    profil.setText(arr1.getString("nama_user"));
                    alamat = arr1.getString("alamat");
                    no_telp = arr1.getString("no_telp");
                    no_rek = arr1.getString("no_rekening");
                    nama_rek = arr1.getString("nama_rekening");
                    nama_bank = arr1.getString("nama_bank");
                    tanggal_lahir = arr1.getString("tanggal_lahir");
                    jenis_kelamin = arr1.getString("jenis_kelamin");
                    tempat_lahir = arr1.getString("tempat_lahir");
                    nik = arr1.getString("nik");
                    pekerjaan = arr1.getString("pekerjaan");
                    finansial = arr1.getString("finansial");

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

            @Override
            public Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<String, String>();

                return params;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(this);

        requestQueue.add(senddata);
    }

    private void getFoto()
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "data_regis/index_get?id_registrasi="
                +authdata.getInstance(ProfilActivity.this).getKodeUser(), new Response.Listener<String>(){
            @Override
            public void onResponse(String response) {
//                pd.cancel();
                JSONObject res = null;
                try {
                    res = new JSONObject(response);
                    Log.e("responnya ",""+response);
                    JSONArray arr = res.getJSONArray("data");
                    JSONObject arr1 = arr.getJSONObject(0);
                    foto = arr1.getString("profil");
                    Picasso.get().load(ServerApi.IPServer + "../" + "uploads/akun/" + foto).into(fotoProfil);

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

            @Override
            public Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> params = new HashMap<String, String>();

                return params;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(this);

        requestQueue.add(senddata);
    }
}
