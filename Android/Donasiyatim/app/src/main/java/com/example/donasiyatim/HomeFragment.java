package com.example.donasiyatim;

import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.annotation.PluralsRes;
import androidx.appcompat.app.AlertDialog;
import androidx.core.app.ActivityCompat;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;
import androidx.recyclerview.widget.LinearLayoutManager;
import androidx.recyclerview.widget.RecyclerView;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.donasiyatim.configfile.ServerApi;
import com.example.donasiyatim.configfile.Util;
import com.example.donasiyatim.configfile.authdata;
import com.squareup.picasso.Picasso;
import com.synnapps.carouselview.CarouselView;
import com.synnapps.carouselview.ImageListener;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class HomeFragment extends Fragment  {
    CarouselView carouselView;
    int[] sampleImage = {
            R.drawable.image1,
            R.drawable.image2
    };
    TextView nama_user, saldo, showAllKasus, showAllBerita;
    ImageView img;
    Button btn_dompet;
    String saldoku, userid, idregis, auth, image;
    RecyclerView rv, rvBerita;
    List<ModelData> modelDataList;
    List<ModelDataBerita> modelDataBeritaList;
    ListAdapter listAdapter;
    ListAdapterBerita listAdapterBerita;
    ImageView imageView;

    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_home, container, false);

        nama_user = v.findViewById(R.id.tv_namauser);
        imageView = v.findViewById(R.id.imageView);
        saldo = v.findViewById(R.id.tv_saldo);
        btn_dompet = v.findViewById(R.id.btn_dompet);
        rv = v.findViewById(R.id.rv);
        rvBerita = v.findViewById(R.id.rv_berita);
        img = v.findViewById(R.id.img_kasus);
        carouselView = v.findViewById(R.id.Banner);
        carouselView.setPageCount(sampleImage.length);
        showAllKasus = v.findViewById(R.id.btn_showAll_kasus);
        showAllBerita = v.findViewById(R.id.btn_showAll_berita);

        loaddetail();
        loadgambar();
        retrieveJSON();
        retrieveJSONBerita();
       auth = authdata.getInstance(getActivity()).getAksesData();
       Log.e("kode user", ""+auth);

        ImageListener imageListener = new ImageListener() {
            @Override
            public void setImageForPosition(int position, ImageView imageView) {
                imageView.setImageResource(sampleImage[position]);
            }
        };

        carouselView.setImageListener(imageListener);

        btn_dompet.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getActivity().getApplicationContext(),DompetActivity.class);
                intent.putExtra("id_regis", idregis);
                intent.putExtra("id_user", userid);
                intent.putExtra("saldo", saldoku);
                startActivity(intent);
            }
        });

        showAllKasus.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getActivity().getApplicationContext(), DonasiActivity.class);
                intent.putExtra("id_user", userid);
                intent.putExtra("saldo", saldoku);
                startActivity(intent);
            }
        });

        showAllBerita.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getActivity().getApplicationContext(), BeritaActivity.class);
                startActivity(intent);
            }
        });

        String val = authdata.getInstance(getActivity()).getKodeUser();
        Log.e("val","testes" + val);
        //nama_user.setText(jenenge);

        return v;
    }

    private void retrieveJSON()
    {
        StringRequest stringRequest  = new StringRequest(Request.Method.GET, ServerApi.IPServer + "kasus/index_get",
                new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Log.d("strrrrr", ">>" + response);
                try {
                    JSONObject obj  = new JSONObject(response);

                    modelDataList = new ArrayList<>();
                    JSONArray data = obj.getJSONArray("data");
                    for (int i = 0; i < 3; i++)
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

        RequestQueue requestQueue = Volley.newRequestQueue(getActivity().getApplicationContext());
        requestQueue.add(stringRequest);
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
                    for (int i = 0; i < 3; i++)
                    {
                        ModelDataBerita playerModel = new ModelDataBerita();
                        JSONObject dataobj = data.getJSONObject(i);
                        playerModel.setID_berita(dataobj.getString("id_berita"));
                        playerModel.setJudul_berita(dataobj.getString("judul"));
                        playerModel.setTanggal_berita(Util.settanggal(dataobj.getString("tanggal_berita")));
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

        RequestQueue requestQueue = Volley.newRequestQueue(getActivity().getApplicationContext());
        requestQueue.add(stringRequest);
    }

    private void setupListBerita()
    {
        listAdapterBerita = new ListAdapterBerita(getContext(), modelDataBeritaList);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(getActivity().getApplicationContext());
        rvBerita.setLayoutManager(layoutManager);
        rvBerita.setAdapter(listAdapterBerita);
    }

    private void setupListView()
    {
        listAdapter = new ListAdapter(getContext(), modelDataList);
        RecyclerView.LayoutManager layoutManager = new LinearLayoutManager(getActivity().getApplicationContext());
        rv.setLayoutManager(layoutManager);
        rv.setAdapter(listAdapter);

    }

    private void loaddetail()//ini buat nampilin saldo
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "Data_User/index_get?id_registrasi="
                +authdata.getInstance(getActivity()).getKodeUser(), new Response.Listener<String>(){
            @Override
            public void onResponse(String response) {
                JSONObject res = null;
                try {
                    res = new JSONObject(response);
                    Log.e("responnya ",""+response);
                    JSONArray arr = res.getJSONArray("data");
                    JSONObject arr1 = arr.getJSONObject(0);
                    saldo.setText(Util.setformatrupiah(arr1.getString("finansial")));
                    nama_user.setText(arr1.getString("nama_user"));
                    idregis = arr1.getString("id_registrasi");
                    Log.e("gambar",""+image);
                    userid = arr1.getString("id_user");
                    Log.e("asd","user id home"+userid);
                    saldoku = arr1.getString("finansial");
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

        };
        RequestQueue requestQueue = Volley.newRequestQueue(getActivity().getApplicationContext());
        requestQueue.add(senddata);
    }

    private void loadgambar()//ini buat nampilin saldo
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "data_regis/index_get?id_registrasi="
                +authdata.getInstance(getActivity()).getKodeUser(), new Response.Listener<String>(){
            @Override
            public void onResponse(String response) {
                JSONObject res = null;
                try {
                    res = new JSONObject(response);
                    Log.e("responnya ",""+response);
                    JSONArray arr = res.getJSONArray("data");
                    JSONObject arr1 = arr.getJSONObject(0);
                    idregis = arr1.getString("id_registrasi");
                    image = arr1.getString("profil");
                    Log.e("gambar",""+image);
                    Picasso.get().load(ServerApi.IPServer + "../" + "uploads/akun/" + image).into(imageView);

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
        RequestQueue requestQueue = Volley.newRequestQueue(getActivity().getApplicationContext());
        requestQueue.add(senddata);
    }


}
