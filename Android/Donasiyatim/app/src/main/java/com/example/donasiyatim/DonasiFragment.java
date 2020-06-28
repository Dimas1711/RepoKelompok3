package com.example.donasiyatim;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.fragment.app.Fragment;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

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

public class DonasiFragment extends Fragment {
    RecyclerView recyclerView;
    ImageView img;
    List<ModelData> modelDataList;
    ListAdapter listAdapter;


    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_donasi, container, false);
        recyclerView = v.findViewById(R.id.recyclerview);
        img = v.findViewById(R.id.imagelv);

        String val = authdata.getInstance(getActivity()).getKodeUser();
        Log.e("val","testes" + val);
        //nama_user.setText(jenenge);
        retrieveJSON();
        return v;

    }
    private void retrieveJSON()
    {
        StringRequest stringRequest  = new StringRequest(Request.Method.GET, ServerApi.URL_LIST_ITEM  , new Response.Listener<String>() {
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
                        playerModel.setTujuan(Util.setformatrupiah(dataobj.getString("tujuan_dana")));
                        playerModel.setImage(dataobj.getString("gambar"));
                        playerModel.setID_Panti(dataobj.getString("id_panti"));
                        playerModel.setID_Kasus(dataobj.getString("id_kasus"));

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

        RequestQueue requestQueue = Volley.newRequestQueue(getContext());
        requestQueue.add(stringRequest);
    }
    private void setupListView()
    {
        listAdapter = new ListAdapter(getContext(), modelDataList);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(getContext());
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setAdapter(listAdapter);

    }

}
