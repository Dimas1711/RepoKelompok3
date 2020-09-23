package com.example.donasiyatim.konten;

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
import com.example.donasiyatim.MainActivity;
import com.example.donasiyatim.R;
import com.example.donasiyatim.configfile.VolleyMultipartRequest;
import com.example.donasiyatim.configfile.ServerApi;
import com.example.donasiyatim.configfile.Util;
import com.karumi.dexter.Dexter;
import com.karumi.dexter.MultiplePermissionsReport;
import com.karumi.dexter.PermissionToken;
import com.karumi.dexter.listener.DexterError;
import com.karumi.dexter.listener.PermissionRequest;
import com.karumi.dexter.listener.PermissionRequestErrorListener;
import com.karumi.dexter.listener.multi.MultiplePermissionsListener;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

import pl.aprilapps.easyphotopicker.EasyImage;

public class UploadFotoActivity extends AppCompatActivity {
    ImageView img_foto;
    Button pilih, upload;
    TextView nama, jumlah, tanggal, bank, va_e;
    public static final int REQUEST_CODE_CAMERA = 001;
    public static final int REQUEST_CODE_GALLERY = 002;
    String id_user, jumlah_inginkan, nama_user;
    Bitmap bitmap;
    String id_akun;
    ProgressDialog pd;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_upload_foto);
        requestMultiplePermissions();
        pd = new ProgressDialog(this);
        img_foto = findViewById(R.id.img_foto);
        pilih = findViewById(R.id.btn_choose);
        upload = findViewById(R.id.btn_upload);
        nama = findViewById(R.id.nama);
        jumlah = findViewById(R.id.jumlah_topup);
        tanggal = findViewById(R.id.tanggal);
        bank = findViewById(R.id.bank);
        va_e = findViewById(R.id.va_e);
        loadbank();

        nama_user = getIntent().getStringExtra("nama_user");

        SimpleDateFormat sdf = new SimpleDateFormat("dd.MM.YYYY 'at' HH:mm:ss");
        String currentDateandTime = sdf.format(new Date());


        tanggal.setText(currentDateandTime);


        id_user = getIntent().getStringExtra("id_user");
        jumlah_inginkan = getIntent().getStringExtra("jumlah_inginkan");


        Log.e("saldo", ""+id_user);
        Log.e("saldo", ""+nama_user);
        Log.e("saldo", ""+jumlah_inginkan);

        id_akun = getIntent().getStringExtra("id_akun");
        Log.e("asd","id_akun e"+id_akun);


        pilih.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                setRequestImage();
            }
        });

        upload.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                loaddetail();
            }
        });

        jumlah.setText(Util.setformatrupiah(jumlah_inginkan));
        nama.setText(nama_user);
    }

    private void loadbank()//ini buat nampilin saldo
    {
        StringRequest senddata = new StringRequest(Request.Method.GET, ServerApi.IPServer + "Account_Finansial/index_get?id_akun="
                +getIntent().getStringExtra("id_akun"),
                new Response.Listener<String>(){
                    @Override
                    public void onResponse(String response) {
                        JSONObject res = null;
                        try {
                            res = new JSONObject(response);
                            Log.e("responnya ",""+response);
                            JSONArray arr = res.getJSONArray("data");
                            JSONObject arr1 = arr.getJSONObject(0);
                            va_e.setText(arr1.getString("no_rekening"));
                            bank.setText(arr1.getString("nama_bank"));
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

    private void setRequestImage(){
        CharSequence[] item = {"Kamera", "Galeri"};
        AlertDialog.Builder request = new AlertDialog.Builder(this)
                .setTitle("Add Image")
                .setItems(item, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {
                        switch (i){
                            case 0:
                                //Membuka Kamera Untuk Mengambil Gambar
                                EasyImage.openCamera(UploadFotoActivity.this, REQUEST_CODE_CAMERA);
                                break;
                            case 1:
                                //Membuaka Galeri Untuk Mengambil Gambar
                                EasyImage.openGallery(UploadFotoActivity.this, REQUEST_CODE_GALLERY);
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
                Toast.makeText(getApplicationContext(), "you don't have permission", Toast.LENGTH_LONG).show();
            }
            return;
        }

        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, @Nullable Intent data) {

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
                        Glide.with(UploadFotoActivity.this)
                                .load(imageFile)
                                .centerCrop()
                                .diskCacheStrategy(DiskCacheStrategy.ALL)
                                .into(img_foto);
                        bitmap = BitmapFactory.decodeFile(imageFile.getPath());
                        Log.e("asd",""+bitmap);
                        break;

                    case REQUEST_CODE_GALLERY:
                        Glide.with(UploadFotoActivity.this)
                                .load(imageFile)
                                .centerCrop()
                                .diskCacheStrategy(DiskCacheStrategy.ALL)
                                .into(img_foto);
                        bitmap = BitmapFactory.decodeFile(imageFile.getPath());
                        break;
                }
            }

            @Override
            public void onCanceled(EasyImage.ImageSource source, int type) {
                //Batalkan penanganan, Anda mungkin ingin menghapus foto yang diambil jika dibatalkan
            }
        });
    }



    private void loaddetail()//ini buat nampilin saldo
    {
        pd.setTitle("Waiting");
        pd.setMessage("Tunggu Sebentar Data Anda Sedang Di Proses");
        pd.show();
        final VolleyMultipartRequest volleyMultipartRequest = new VolleyMultipartRequest(Request.Method.POST, ServerApi.IPServer
                + "Top_Up/index_post",new Response.Listener<NetworkResponse>(){
                    @Override
                    public void onResponse(NetworkResponse response) {
                        Log.e("asd",""+response);
                        try {
//                            pd.dismiss();
                            Log.e("asd", ""+response);
                            Toast.makeText(UploadFotoActivity.this, "Upload Bukti Berhasil ", Toast.LENGTH_SHORT).show();
                            Intent intent = new Intent(UploadFotoActivity.this, MainActivity.class);
                            startActivity(intent);

                        } catch (Exception e) {
                            pd.dismiss();
                            Log.e("asd", ""+response);
                            Toast.makeText(UploadFotoActivity.this, "Upload Bukti Berhasil ", Toast.LENGTH_SHORT).show();
                            Intent intent = new Intent(UploadFotoActivity.this, MainActivity.class);
                            startActivity(intent);

                        }
                    }
                },
                new Response.ErrorListener() {
                    @Override
                    public void onErrorResponse(VolleyError error) {
                        pd.dismiss();
                        Toast.makeText(UploadFotoActivity.this, "Upload Bukti Berhasil ", Toast.LENGTH_SHORT).show();
                        Intent intent = new Intent(UploadFotoActivity.this, MainActivity.class);
                        startActivity(intent);

                    }
                }) {
            protected Map<String, String> getParams() throws AuthFailureError {
                Map<String , String> params = new HashMap<>();
                params.put("id_user" , id_user);
                params.put("jumlah_inginkan" , jumlah_inginkan);
                return params;
            }

            @Override
            protected Map<String, DataPart> getByteData() throws AuthFailureError {
                Map<String, DataPart> params = new HashMap<>();
                long imagename = System.currentTimeMillis();
                    params.put("foto", new DataPart(imagename + ".JPEG", getFileDataFromDrawable(bitmap)));
                Log.e("asd",""+imagename);
                return params;
            }
        };
        Volley.newRequestQueue(this).add(volleyMultipartRequest);
    }

    private void  requestMultiplePermissions(){
        Dexter.withActivity(this)
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
                        Toast.makeText(getApplicationContext(), "Some Error! ", Toast.LENGTH_SHORT).show();
                    }
                })
                .onSameThread()
                .check();
    }



    public byte[] getFileDataFromDrawable(Bitmap bitmap) {
        ByteArrayOutputStream byteArrayOutputStream = new ByteArrayOutputStream();
        bitmap.compress(Bitmap.CompressFormat.JPEG, 80, byteArrayOutputStream);
        return byteArrayOutputStream.toByteArray();
    }
}
