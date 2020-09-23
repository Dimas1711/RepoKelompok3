package com.example.donasiyatim.auth;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.donasiyatim.MainActivity;
import com.example.donasiyatim.R;
import com.example.donasiyatim.configfile.ServerApi;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class GantiPassActivity extends AppCompatActivity {

    EditText passlama, passbaru, passkonf;
    Button simpan, kembali;
    String id_regis, password;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_ganti_pass);

        passlama = findViewById(R.id.passlama);
        passbaru = findViewById(R.id.passbaru);
        passkonf = findViewById(R.id.passkonf);
        simpan = findViewById(R.id.ok);
        kembali = findViewById(R.id.ext);

        id_regis = getIntent().getStringExtra("id_regis");
        password = getIntent().getStringExtra("password");
        Log.e("asd", "id_regis e"+password);

        kembali.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(GantiPassActivity.this, MainActivity.class);
                startActivity(intent);
            }
        });

        simpan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (passlama.getText().toString().equals("") || passbaru.getText().toString().equals("") || passkonf.getText().toString().equals(""))
                {
                    Toast.makeText(GantiPassActivity.this, "Field tidak boleh kosong", Toast.LENGTH_SHORT).show();
                }
                else
                {
                    ubahpass();
                }

            }
        });

    }

    private void ubahpass()//ini buat nampilin saldo
    {
        StringRequest senddata = new StringRequest(Request.Method.PUT, ServerApi.IPServer + "Update_Password/index_put",
                new Response.Listener<String>(){

                    @Override
                    public void onResponse(String response) {
                        try {
                            JSONObject res = new JSONObject(response);
                            Toast.makeText(GantiPassActivity.this, res.getString("message"), Toast.LENGTH_SHORT).show();
                            if (res.optString("status").equals("true")) {
                                Intent intent = new Intent(GantiPassActivity.this, MainActivity.class);
                                startActivity(intent);
                            }
                            else
                            {
                                Toast.makeText(GantiPassActivity.this, res.getString("message"), Toast.LENGTH_SHORT).show();
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
                params.put("id_registrasi" , id_regis);
                params.put("password" , passlama.getText().toString());
                params.put("passwordbaru" , passbaru.getText().toString());
                params.put("passkonf" , passkonf.getText().toString());

                return params;
            }

        };
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(senddata);
    }
}
