package com.example.donasiyatim.auth;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.webkit.WebView;
import android.webkit.WebViewClient;

import com.example.donasiyatim.R;

public class ResetPassActivity extends AppCompatActivity {
    WebView web_view;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reset_pass);

        web_view = findViewById(R.id.web_view);
        web_view.loadUrl("http://donasipanti.flow-byte.com/auth/forgot_password");
        web_view.setWebViewClient(new WebViewClient());
    }
}
