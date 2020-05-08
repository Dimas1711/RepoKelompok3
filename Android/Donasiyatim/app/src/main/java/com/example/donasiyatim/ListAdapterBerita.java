package com.example.donasiyatim;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.example.donasiyatim.configfile.ServerApi;
import com.squareup.picasso.Picasso;

import java.util.List;

public class ListAdapterBerita extends RecyclerView.Adapter<ListAdapterBerita.HolderDataBerita> {
    private List<ModelDataBerita> mItems;
    private Context context;

    public ListAdapterBerita(Context context, List<ModelDataBerita> modelDataListBerita)
    {
        this.context = context;
        this.mItems = modelDataListBerita;
    }
    @NonNull
    @Override
    public HolderDataBerita onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View layout = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_item_berita, parent,false);
        ListAdapterBerita.HolderDataBerita holderDataBerita = new ListAdapterBerita.HolderDataBerita(layout);
        return holderDataBerita;
    }

    @Override
    public void onBindViewHolder(@NonNull final HolderDataBerita holder, int position) {
        ModelDataBerita me = mItems.get(position);

        holder.judul_berita.setText(me.getJudul_berita());
        holder.tanggal_berita.setText(me.getTanggal_berita());
        Picasso.get().load(ServerApi.IPServer + "../" + "uploads/berita/" + me.getGambar_berita()).into(holder.image_berita);

    }

    @Override
    public int getItemCount() {
        return mItems.size();
    }

    public class HolderDataBerita extends RecyclerView.ViewHolder {
        TextView judul_berita,tanggal_berita;
        ImageView image_berita;
        public HolderDataBerita(@NonNull View itemView) {
            super(itemView);
            judul_berita = itemView.findViewById(R.id.tv_judul_berita);
            tanggal_berita = itemView.findViewById(R.id.tv_tanggal_berita);
            image_berita = itemView.findViewById(R.id.img_berita);
        }
    }
}
