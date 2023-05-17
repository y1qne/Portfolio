import { useEffect, useState } from 'react';
import Album from './Album.js'

function ArtistDetail({artist_id}){
    const [artist_info, setArtistInfo] = useState([]);
    const [album_list, setTrackList] = useState([]);

    fetch(`http://localhost:8000/artists/${artist_id}`)
            .then(res => res.json())
            .then(json => {
                setArtistInfo(json);
            });
    fetch(`http://localhost:8000/albums`)
    .then(res => res.json())
    .then(json => {
        const filteredTracks = json.filter(track => track.artist_id === artist_id);
        setTrackList(filteredTracks);
    });

    return (
        <>
            <div>{artist_info['name']}</div>
            <div>{artist_info['photo']}</div>
            <div>{artist_info['bio']}</div>
            {
                album_list.map((album) => {
                    return <Album album_name={album['name']} album_pic={album['cover']}  key={album['id']} />;
                })
            }
        </>
    );

}

export default ArtistDetail;