import AlbumDetail from "./AlbumDetail";

function Album({ album_name, album_pic, cle }) {
    const id = `album-${cle}`;

    function handleClickAlbum(){
        return (
            <AlbumDetail album_id={cle}/>
        );
    };

    return (
        <div className="album" id={id} onClick={handleClickAlbum}>
            <img src={album_pic}></img>
            <div>{album_name}</div>
        </div>
    );
}

export default Album;