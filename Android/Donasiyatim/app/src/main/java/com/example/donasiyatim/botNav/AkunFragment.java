package com.example.donasiyatim.botNav;

import android.content.DialogInterface;
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
import androidx.appcompat.app.AlertDialog;
import androidx.fragment.app.Fragment;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.donasiyatim.konten.EditDataActivity;
import com.example.donasiyatim.konten.EditprofilActivity;
import com.example.donasiyatim.auth.LoginActivity;
import com.example.donasiyatim.R;
import com.example.donasiyatim.konten.Tentang;
import com.example.donasiyatim.configfile.ServerApi;
import com.example.donasiyatim.configfile.authdata;
import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class AkunFragment extends Fragment {
    ImageView img_profil;
    TextView btn_ganti_foto, btnEditProfil, nama_user, btnEditData, btnLogout, nama_email, tentangkami;
    String id_regis,pass, email, gambar, nama, alamat,no_telp, no_rek, nama_rek, nama_bank, tanggal_lahir, jenis_kelamin, tempat_lahir, nik, pekerjaan, finansial;


    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        View v = inflater.inflate(R.layout.fragment_akun, container, false);

        loadgambar();
        loaddata();
        btn_ganti_foto = v.findViewById(R.id.btn_fotoganti);
        img_profil = v.findViewById(R.id.img_profil);
        nama_user = v.findViewById(R.id.nama_user);
        nama_email = v.findViewById(R.id.email);
        btnEditProfil = v.findViewById(R.id.editProfil);
        btnEditData = v.findViewById(R.id.editData);
        btnLogout = v.findViewById(R.id.btn_logout);
        tentangkami = v.findViewById(R.id.tentangkami);
        id_regis = authdata.getInstance(getActivity()).getKodeUser();

        Log.e("asdfgh", "onCreateView: "+ id_regis);

        tentangkami.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(getContext(), Tentang.class);
                startActivity(intent);
            }
        });

        btnEditProfil.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent edt = new Intent(getContext(), EditprofilActivity.class);
                edt.putExtra("alamat", alamat);
                edt.putExtra("no_telp", no_telp);
                edt.putExtra("no_rek", no_rek);
                edt.putExtra("nama_rek", nama_rek);
                edt.putExtra("nama_bank", nama_bank);
                edt.putExtra("tanggal_lahir", tanggal_lahir);
                edt.putExtra("jenis_kelamin", jenis_kelamin);
                edt.putExtra("tempat_lahir", tempat_lahir);
                edt.putExtra("nik", nik);
                edt.putExtra("nama", nama);
                edt.putExtra("email", email);
                edt.putExtra("pekerjaan", pekerjaan);
                edt.putExtra("finansial", finansial);
                startActivity(edt);
            }
        });

        btnEditData.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent edt = new Intent(getContext(), EditDataActivity.class);
                edt.putExtra("alamat", alamat);
                edt.putExtra("no_telp", no_telp);
                edt.putExtra("no_rek", no_rek);
                edt.putExtra("nama_rek", nama_rek);
                edt.putExtra("nama_bank", nama_bank);
                edt.putExtra("tanggal_lahir", tanggal_lahir);
                edt.putExtra("jenis_kelamin", jenis_kelamin);
                edt.putExtra("tempat_lahir", tempat_lahir);
                edt.putExtra("nik", nik);
                edt.putExtra("nama", nama);
                edt.putExtra("email", email);
                edt.putExtra("pekerjaan", pekerjaan);
                edt.putExtra("finansial", finansial);
                startActivity(edt);
            }
        });


        btnLogout.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showDialog();
            }
        });

        return v;
    }



    private void loaddata()//ini buat nampilin saldo
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
                    id_regis = arr1.getString("id_registrasi");
                    nama = arr1.getString("nama_user");
                    alamat = arr1.getString("alamat");
                    no_telp = arr1.getString("no_telp");
                    email = arr1.getString("email");
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

        };
        RequestQueue requestQueue = Volley.newRequestQueue(getContext());
        requestQueue.add(senddata);
    }



    private void loadgambar()//ini buat nampilin saldo
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "Data_Regis/index_get?id_registrasi="
                +authdata.getInstance(getActivity()).getKodeUser(), new Response.Listener<String>(){
            @Override
            public void onResponse(String response) {
                JSONObject res = null;
                try {
                    res = new JSONObject(response);
                    Log.e("responnya ",""+response);
                    JSONArray arr = res.getJSONArray("data");
                    JSONObject arr1 = arr.getJSONObject(0);
                    gambar = arr1.getString("profil");
                    nama = arr1.getString("nama");
                    email = arr1.getString("email");
                    pass = arr1.getString("password");
                    Log.e("asd", "pass e "+pass);
                    nama_user.setText(nama);
                    nama_email.setText(email);
                    Picasso.get().load(ServerApi.IPServer + "../" + "uploads/akun/" + gambar).into(img_profil);


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
        RequestQueue requestQueue = Volley.newRequestQueue(getContext());
        requestQueue.add(senddata);
    }

    private void showDialog(){
        AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(
                getContext());

        // set title dialog
        alertDialogBuilder.setTitle("Yakin Logout Akun?");

        // set pesan dari dialog
        alertDialogBuilder
                .setMessage("Klik Ya untuk logout!")
                .setIcon(R.mipmap.ic_panti)
                .setCancelable(false)
                .setPositiveButton("Ya",new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog,int id) {
                        // jika tombol diklik, maka akan menutup activity ini
                        authdata.getInstance(getContext()).logout();
                        Intent intent = new Intent(getActivity(), LoginActivity.class);
                        startActivity(intent);
                    }
                })
                .setNegativeButton("Tidak",new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int id) {
                        // jika tombol ini diklik, akan menutup dialog
                        // dan tidak terjadi apa2
                        dialog.cancel();
                    }
                });

        // membuat alert dialog dari builder
        AlertDialog alertDialog = alertDialogBuilder.create();

        // menampilkan alert dialog
        alertDialog.show();
    }

}
