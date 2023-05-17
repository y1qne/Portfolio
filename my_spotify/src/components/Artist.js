function Artist({ artist_name, artist_pic, cle }) {
    const id = `artist-${cle}`;
    return (
        <div className="artist" id={id}>
            <img src={artist_pic}></img>
            <div>{artist_name}</div>
        </div>
    );
}

export default Artist;