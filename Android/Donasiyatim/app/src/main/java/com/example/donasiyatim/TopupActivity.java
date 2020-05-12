package com.example.donasiyatim;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
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

import java.util.HashMap;
import java.util.Map;

public class TopupActivity extends AppCompatActivity {
    TextView rp50, rp100;
    EditText isi;
    Button btn;
    String id_user;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_topup);

        id_user = getIntent().getStringExtra("id_user");

        rp50 = findViewById(R.id.rp50);
        rp100 = findViewById(R.id.rp100);
        isi = findViewById(R.id.uang_e);
        btn = findViewById(R.id.btn_isisaldo);

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
        StringRequest senddata = new StringRequest(Request.Method.POST, ServerApi.IPServer + "top_up/index_get",
                new Response.Listener<String>(){
                    @Override
                    public void onResponse(String response) {
                        JSONObject res = null;
                        try {
                            res = new JSONObject(response);
                            Log.e("responnya ",""+response);
                            JSONArray arr = res.getJSONArray("data");
                            JSONObject arr1 = arr.getJSONObject(0);
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
            protected Map<String, String> getParams(){
                Map<String , String> params = new HashMap<>();
                params.put("id_user" , id_user);
                params.put("jumlah_inginkan" , isi.getText().toString());
                params.put("foto" , "");

                return params;
            }

        };
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(senddata);
    }
}
