package com.example.donasiyatim;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
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
import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class ProsesDonasiActivity extends AppCompatActivity {
    TextView rp50, rp100;
    EditText isi;
    Button btn;
    String id_user, id_kasus;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_proses_donasi);

        id_user = getIntent().getStringExtra("id_user");
        id_kasus = getIntent().getStringExtra("id_kasus");

        Log.e("erronya ","id kasus = "+id_kasus);
        Log.e("erronya ","id user ="+id_user);

        rp50 = findViewById(R.id.rp50_donasi);
        rp100 = findViewById(R.id.rp100_donasi);
        isi = findViewById(R.id.uang_e_donasi);
        btn = findViewById(R.id.btn_isidonasi);

        rp50.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                isi.setText("50000");
            }
        });
        btn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                loaddetail();
            }
        });
    }

    private void loaddetail()//ini buat nampilin saldo
    {
        StringRequest senddata = new StringRequest(Request.Method.POST, ServerApi.IPServer + "Donasi/index_post",
                new Response.Listener<String>(){

                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject res = new JSONObject(response);
                            if (res.optString("status").equals("true")) {
                                Toast.makeText(ProsesDonasiActivity.this, res.getString("pesan"), Toast.LENGTH_SHORT).show();
                                Intent intent = new Intent(ProsesDonasiActivity.this, MainActivity.class);
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
}
