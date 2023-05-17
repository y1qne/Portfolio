import { useEffect, useState } from 'react';
import Track from './Track.js'

function AlbumDetail({album_id}){
    const [album_info, setAlbumInfo] = useState([]);
    const [track_list, setTrackList] = useState([]);
    const [artist, setArtist] = useState('');

    fetch(`http://localhost:8000/albums/${album_id}`)
            .then(res => res.json())
            .then(json => {
                setAlbumInfo(json);
            });
    fetch(`http://localhost:8000/artists/${album_info['artist_id']}`)
    .then(res => res.json())
    .then(json => {
        setArtist(json['name']);
    });
    fetch(`http://localhost:8000/tracks`)
    .then(res => res.json())
    .then(json => {
        const filteredTracks = json.filter(track => track.album_id === album_id);
        setTrackList(filteredTracks);
    });

    return (
        <>
            <div>{album_info['name']}</div>
            <div>{album_info['cover']}</div>
            <div>{artist}</div>
            <div>{album_info['bio']}</div>
            {
                track_list.map((track) => {
                    return <Track track_name={track['name']} track_src={track['mp3']} />;
                })
            }
        </>
    );

}

export default AlbumDetail;