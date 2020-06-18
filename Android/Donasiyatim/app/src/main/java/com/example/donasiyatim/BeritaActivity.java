package com.example.donasiyatim;

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
import com.example.donasiyatim.configfile.ServerApi;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class BeritaActivity extends AppCompatActivity {

    RecyclerView rvBerita;
    List<ModelDataBerita> modelDataBeritaList;
    ListAdapterBerita listAdapterBerita;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_berita);

        rvBerita = findViewById(R.id.rv_berita);

        retrieveJSONBerita();
    }

    private void retrieveJSONBerita()
    {
        StringRequest stringRequest  = new StringRequest(Request.Method.GET, ServerApi.IPServer + "berita/index_get",
                new Response.Listener<String>() {
            @Override
            public void onResponse(String responseBerita) {
                Log.d("strrrrr", ">>" + responseBerita);
                try {
                    JSONObject obj  = new JSONObject(responseBerita);

                    modelDataBeritaList = new ArrayList<>();
                    JSONArray data = obj.getJSONArray("data");
                    for (int i = 0; i < data.length(); i++)
                    {
                        ModelDataBerita playerModel = new ModelDataBerita();
                        JSONObject dataobj = data.getJSONObject(i);
                        playerModel.setID_berita(dataobj.getString("id_berita"));
                        playerModel.setJudul_berita(dataobj.getString("judul"));
                        playerModel.setTanggal_berita(dataobj.getString("tanggal_berita"));
                        playerModel.setGambar_berita(dataobj.getString("gambar"));

                        modelDataBeritaList.add(playerModel);
                    }
                    setupListBerita();

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

    private void setupListBerita()
    {
        listAdapterBerita = new ListAdapterBerita(this, modelDataBeritaList);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(this.getApplicationContext());
        rvBerita.setLayoutManager(layoutManager);
        rvBerita.setAdapter(listAdapterBerita);
    }
}
