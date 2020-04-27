package com.example.donasiyatim;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.util.Log;
import android.widget.Button;
import android.widget.TextView;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.donasiyatim.configfile.AppController;
import com.example.donasiyatim.configfile.ServerApi;
import com.example.donasiyatim.configfile.Util;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class MainActivity extends AppCompatActivity {
    TextView nama_user, saldo;
    Button btn_dompet;
    String id_regis;
    String saldoku;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        nama_user = findViewById(R.id.tv_namauser);
        saldo = findViewById(R.id.tv_saldo);
        btn_dompet = findViewById(R.id.btn_dompet);

        String jenenge = getIntent().getStringExtra("jeneng");
        id_regis = getIntent().getStringExtra("id_registrasi");

        nama_user.setText(jenenge);
        loaddetail();
    }

    private void loaddetail()//ini buat nampilin saldo
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "data_user/index_get", new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                JSONObject res = null;
                try {
                    res = new JSONObject(response);
                    Log.e("responnya ",""+response);
                    JSONArray arr = res.getJSONArray("data");
                    JSONObject arr1 = arr.getJSONObject(0);
                    saldo.setText(arr1.getString("finansial"));
                    saldoku = arr.getString(14);
                    Log.e("saldo", ""+saldoku);
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
                params.put("id_registrasi", id_regis);
                return params;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(MainActivity.this);

        requestQueue.add(senddata);
    }
}
