package com.example.donasiyatim;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.Manifest;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.NetworkResponse;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.example.donasiyatim.configfile.AppController;
import com.example.donasiyatim.configfile.ServerApi;
import com.example.donasiyatim.configfile.authdata;
import com.karumi.dexter.Dexter;
import com.karumi.dexter.MultiplePermissionsReport;
import com.karumi.dexter.PermissionToken;
import com.karumi.dexter.listener.DexterError;
import com.karumi.dexter.listener.PermissionRequest;
import com.karumi.dexter.listener.PermissionRequestErrorListener;
import com.karumi.dexter.listener.multi.MultiplePermissionsListener;
import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import pl.aprilapps.easyphotopicker.EasyImage;

public class EditprofilActivity extends AppCompatActivity {
    ImageView img_profil;
    TextView btn_ganti_foto, ganti_pass;
    String id_regis, nama, password, gambar, alamat,no_telp, no_rek, nama_rek, nama_bank, tanggal_lahir, jenis_kelamin, tempat_lahir, nik, pekerjaan, finansial;
    public static final int REQUEST_CODE_CAMERA = 001;
    public static final int REQUEST_CODE_GALLERY = 002;
    Bitmap bitmap;
    EditText edemail;
    Button simpan, back;
    ProgressDialog pd;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_editprofil);

        requestMultiplePermissions();
        loadgambar();
        pd = new ProgressDialog(this);


        id_regis = authdata.getInstance(EditprofilActivity.this).getKodeUser();
        nama = getIntent().getStringExtra("nama");
        alamat = getIntent().getStringExtra("alamat");
        no_telp = getIntent().getStringExtra("no_telp");
        no_rek = getIntent().getStringExtra("no_rek");
        nama_rek = getIntent().getStringExtra("nama_rek");
        nama_bank = getIntent().getStringExtra("nama_bank");
        tanggal_lahir = getIntent().getStringExtra("tanggal_lahir");
        jenis_kelamin = getIntent().getStringExtra("jenis_kelamin");
        tempat_lahir = getIntent().getStringExtra("tempat_lahir");
        nik = getIntent().getStringExtra("nik");
        finansial = getIntent().getStringExtra("finansial");

        Log.e("asd", "id regis e"+id_regis);
        Log.e("asd", "nama e"+nama);
        Log.e("asd", "no telp e"+no_telp);
        Log.e("asd", "no rek e"+no_rek);
        Log.e("asd", "nama rek e"+nama_rek);
        Log.e("asd", "nama bank e"+nama_bank);
        Log.e("asd", "tanggal lahir e"+tanggal_lahir);
        Log.e("asd", "tempat lahir e"+tempat_lahir);
        Log.e("asd", "nik e"+nik);
        Log.e("asd", "finansial e"+finansial);



        btn_ganti_foto = findViewById(R.id.btn_fotoganti);
        img_profil = findViewById(R.id.profil);
        simpan = findViewById(R.id.save);
        back = findViewById(R.id.back);
        edemail = findViewById(R.id.editemail);
        ganti_pass = findViewById(R.id.gantipass);


        back.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent back = new Intent(EditprofilActivity.this, MainActivity.class);
                startActivity(back);

            }
        });

        simpan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (edemail.getText().toString().equals(""))
                {
                    Toast.makeText(EditprofilActivity.this, "Field tidak boleh kosong", Toast.LENGTH_SHORT).show();
                }
                else
                {
                    Log.e("asd", "email e"+edemail.getText().toString());
                    update();
                }

            }
        });

        ganti_pass.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(EditprofilActivity.this, GantiPassActivity.class);
                intent.putExtra("password", password);
                intent.putExtra("id_regis",id_regis);
                startActivity(intent);
            }
        });


        btn_ganti_foto.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                setRequestImage();
            }
        });
    }



    private void update()
    {
        StringRequest senddata = new StringRequest(Request.Method.PUT, ServerApi.IPServer + "Update_Email/index_put",
                new Response.Listener<String>(){

                    @Override
                    public void onResponse(String response) {
                        try {
                            Toast.makeText(EditprofilActivity.this, "Ubah Email Berhasil", Toast.LENGTH_SHORT).show();
                            Intent intent = new Intent(EditprofilActivity.this, MainActivity.class);
                            startActivity(intent);
                        } catch (Exception e) {
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
                params.put("id_registrasi", id_regis);
                params.put("email" , edemail.getText().toString());
                return params;

            }

        };
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(senddata);
    }





    private void setRequestImage(){
        CharSequence[] item = {"Kamera", "Galeri"};
        AlertDialog.Builder request = new AlertDialog.Builder(EditprofilActivity.this)
                .setTitle("Add Image")
                .setItems(item, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        switch (i){
                            case 0:
                                //Membuka Kamera Untuk Mengambil Gambar
                                EasyImage.openCamera(EditprofilActivity.this, REQUEST_CODE_CAMERA);
                                break;
                            case 1:
                                //Membuaka Galeri Untuk Mengambil Gambar
                                EasyImage.openGallery(EditprofilActivity.this, REQUEST_CODE_GALLERY);
                                break;
                        }
                    }
                });
        request.create();
        request.show();
    }


    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        if (requestCode == REQUEST_CODE_GALLERY)
        {
            if (grantResults.length > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED)
            {
                Intent intent = new Intent(Intent.ACTION_PICK);
                intent.setType("image/*");
                startActivityForResult(Intent.createChooser(intent, "select image"), REQUEST_CODE_GALLERY);
            }
            else
            {
                Toast.makeText(EditprofilActivity.this, "you don't have permission", Toast.LENGTH_LONG).show();
            }
            return;
        }

        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {

        super.onActivityResult(requestCode, resultCode, data);
        EasyImage.handleActivityResult(requestCode, resultCode, data, this, new EasyImage.Callbacks() {

            @Override
            public void onImagePickerError(Exception e, EasyImage.ImageSource source, int type) {
                //Method Ini Digunakan Untuk Menghandle Error pada Image
            }

            @Override
            public void onImagePicked(File imageFile, EasyImage.ImageSource source, int type) {
                //Method Ini Digunakan Untuk Menghandle Image
                switch (type){
                    case REQUEST_CODE_CAMERA:
                        Glide.with(EditprofilActivity.this)
                                .load(imageFile)
                                .centerCrop()
                                .diskCacheStrategy(DiskCacheStrategy.ALL)
                                .into(img_profil);
                        bitmap = BitmapFactory.decodeFile(imageFile.getPath());
                        Log.e("asd",""+bitmap);
                        showDialog();
                        break;

                    case REQUEST_CODE_GALLERY:
                        Glide.with(EditprofilActivity.this)
                                .load(imageFile)
                                .centerCrop()
                                .diskCacheStrategy(DiskCacheStrategy.ALL)
                                .into(img_profil);
                        bitmap = BitmapFactory.decodeFile(imageFile.getPath());
                        showDialog();
                        break;
                }
            }

            @Override
            public void onCanceled(EasyImage.ImageSource source, int type) {
                //Batalkan penanganan, Anda mungkin ingin menghapus foto yang diambil jika dibatalkan
            }
        });
    }


    private void  requestMultiplePermissions(){
        Dexter.withActivity(EditprofilActivity.this)
                .withPermissions(
                        Manifest.permission.CAMERA,
                        Manifest.permission.WRITE_EXTERNAL_STORAGE,
                        Manifest.permission.READ_EXTERNAL_STORAGE)
                .withListener(new MultiplePermissionsListener() {
                    @Override
                    public void onPermissionsChecked(MultiplePermissionsReport report) {
                        // check if all permissions are granted
                        if (report.areAllPermissionsGranted()) {
//                            Toast.makeText(getApplicationContext(), "All permissions are granted by user!", Toast.LENGTH_SHORT).show();
                        }

                        // check for permanent denial of any permission
                        if (report.isAnyPermissionPermanentlyDenied()) {
                            // show alert dialog navigating to Settings
                            //openSettingsDialog();
                        }
                    }

                    @Override
                    public void onPermissionRationaleShouldBeShown(List<PermissionRequest> permissions, PermissionToken token) {
                        token.continuePermissionRequest();
                    }
                }).
                withErrorListener(new PermissionRequestErrorListener() {
                    @Override
                    public void onError(DexterError error) {
                        Toast.makeText(EditprofilActivity.this, "Some Error! ", Toast.LENGTH_SHORT).show();
                    }
                })
                .onSameThread()
                .check();
    }



    public byte[] getFileDataFromDrawable(Bitmap bitmap) {
        ByteArrayOutputStream byteArrayOutputStream = new ByteArrayOutputStream();
        bitmap.compress(Bitmap.CompressFormat.PNG, 80, byteArrayOutputStream);
        return byteArrayOutputStream.toByteArray();
    }

    private void loadgambar()//ini buat nampilin saldo
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "Data_Regis/index_get?id_registrasi="
                +authdata.getInstance(EditprofilActivity.this).getKodeUser(), new Response.Listener<String>(){
            @Override
            public void onResponse(String response) {
                JSONObject res = null;
                try {
                    res = new JSONObject(response);
                    Log.e("responnya ",""+response);
                    JSONArray arr = res.getJSONArray("data");
                    JSONObject arr1 = arr.getJSONObject(0);
                    gambar = arr1.getString("profil");
                    password = arr1.getString("password");
                    Log.e("asd","password e"+password);
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
        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(senddata);
    }


    private void loaddetail()
    {
        pd.setTitle("Waiting");
        pd.setMessage("Tunggu Sebentar Data Anda Sedang Di Proses");
        pd.show();
        final VolleyMultipartRequest volleyMultipartRequest = new VolleyMultipartRequest(Request.Method.POST,
                ServerApi.IPServer + "Data_User/index_post",new Response.Listener<NetworkResponse>(){
            @Override
            public void onResponse(NetworkResponse response) {
                Log.e("asd",""+response);
                try {
                    pd.dismiss();
                    Log.e("asd", ""+response);
                    Toast.makeText(EditprofilActivity.this, "Upload Foto Profil Berhasil ", Toast.LENGTH_SHORT).show();

                } catch (Exception e) {
                    pd.dismiss();
                    Toast.makeText(EditprofilActivity.this, "Upload Foto Profil Gagal ", Toast.LENGTH_SHORT).show();
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
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String , String> params = new HashMap<>();
                params.put("id_registrasi" , id_regis);
                return params;
            }

            @Override
            protected Map<String, DataPart> getByteData() throws AuthFailureError {
                Map<String, DataPart> params = new HashMap<>();
                long imagename = System.currentTimeMillis();
                params.put("profil", new DataPart(imagename + ".png", getFileDataFromDrawable(bitmap)));
                Log.e("asd",""+imagename);
                return params;
            }
        };
        Volley.newRequestQueue(this).add(volleyMultipartRequest);
    }


    private void showDialog(){
        AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(
                this);

        // set title dialog
        alertDialogBuilder.setTitle("Simpan Perubahan?");

        // set pesan dari dialog
        alertDialogBuilder
                .setMessage("Klik Ya untuk simpan!")
                .setIcon(R.mipmap.ic_launcher)
                .setCancelable(false)
                .setPositiveButton("Ya",new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog,int id) {
                        // jika tombol diklik, maka akan menutup activity ini
                        loaddetail();
                    }
                })
                .setNegativeButton("Tidak",new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int id) {
                        // jika tombol ini diklik, akan menutup dialog
                        // dan tidak terjadi apa2
                        loadgambar();
                        dialog.cancel();
                    }
                });

        // membuat alert dialog dari builder
        AlertDialog alertDialog = alertDialogBuilder.create();

        // menampilkan alert dialog
        alertDialog.show();
    }
}
