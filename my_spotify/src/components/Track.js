function Track({ track_name, track_src}) {
    return (
        <>
        <div>{track_name}</div>
        <audio controls>
        <source src={track_src} type="audio/mp3"></source>
        Your browser does not support the audio element.
        </audio>
        </>
    );
}

export default Track;