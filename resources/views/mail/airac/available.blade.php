<link href="https://fonts.bunny.net/css?family=rubik:100,200,300,400,500,600,700,800,900&display=swap"
      rel="stylesheet"/>
<div style="background-color: #f1f5f9; height: 100vh;width:100vw;overflow: auto;font-family: Rubik, sans-serif">
    <div style="width:30%; margin: 3rem auto; background-color: white; padding: 2rem 1rem; border-radius: .5rem">
        <h2 style="font-weight: 400;">Hello!</h2>

        <div style="color: gray;">
            <p>
                A new AIRAC cycle is available as of today, <span style="font-weight: 900">{{ $cycle->ident }}</span>.
            </p>

            <p style="margin-bottom: 0.5rem">
                You can download this cycle using Navigraph Hub (MSFS) or the FMS Data Manager (X-Plane, FSX and
                Prepar3D).
            </p>

            <p style="margin-top: 0.5rem">
                Both can be downloaded <a href="https://navigraph.com/downloads">here</a>.
            </p>

            <p style="margin-bottom:0.5rem">
                If you wish to no longer receive these updates, you can do so by clicking <a href="{{ $url }}">this</a>
                link.
            </p>

            <p style="margin: 0.5rem 0">
                If that doesn't work, copy and paste this link into your browser:
            </p>

            <p style="overflow-wrap: break-word">
                {{ $url }}
            </p>

            <p style="margin-top: 3rem">
                Kind regards and happy flying!
            </p>
        </div>
    </div>
</div>
