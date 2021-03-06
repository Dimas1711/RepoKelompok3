package com.example.donasiyatim.konten;

import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import android.os.Bundle;
import android.util.Log;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.donasiyatim.R;
import com.example.donasiyatim.adapter.ListAdapter;
import com.example.donasiyatim.configfile.ServerApi;
import com.example.donasiyatim.configfile.Util;
import com.example.donasiyatim.model.ModelData;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class DonasiActivity extends AppCompatActivity{
    RecyclerView rv;
    List<ModelData> modelDataList;
    ListAdapter listAdapter;
    String saldo;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_donasi);
        rv = findViewById(R.id.rv);

        saldo = getIntent().getStringExtra("saldo");

        retrieveJSON();
    }

    private void retrieveJSON()
    {
        StringRequest stringRequest  = new StringRequest(Request.Method.GET, ServerApi.IPServer + "kasus/index_get", new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Log.d("strrrrr", ">>" + response);
                try {
                    JSONObject obj  = new JSONObject(response);

                    modelDataList = new ArrayList<>();
                    JSONArray data = obj.getJSONArray("data");
                    for (int i = 0; i < data.length(); i++)
                    {
                        ModelData playerModel = new ModelData();
                        JSONObject dataobj = data.getJSONObject(i);
                        playerModel.setJudul(dataobj.getString("judul"));
                        playerModel.setID_Kasus(dataobj.getString("id_kasus"));
                        playerModel.setTujuan(Util.setformatrupiah(dataobj.getString("tujuan_dana")));
                        playerModel.setImage(dataobj.getString("gambar"));
                        playerModel.setID_Panti(dataobj.getString("id_panti"));

                        modelDataList.add(playerModel);
                    }
                    setupListView();

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

    private void setupListView()
    {
        listAdapter = new ListAdapter(this, modelDataList);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(this);
        rv.setLayoutManager(layoutManager);
        rv.setAdapter(listAdapter);

    }
}
