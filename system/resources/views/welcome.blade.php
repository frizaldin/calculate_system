<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Zarufiru</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('logo-red.png') }}">

    <style>
        * {
            font-family: "Instrument Sans", ui-sans-serif, system-ui, sans-serif;
        }

        body {
            background-color: #0a0a0a;
            color: #ededec;
            overflow: hidden;
            background: url('{{ asset('globe.png') }}');
            background-color: #0a0a0ac4;
            background-blend-mode: overlay;
        }

        .main-card {
            background-color: #161615;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 250, 237, 0.08);
            backdrop-filter: blur(4px);
        }

        .timeline-item {
            position: relative;
            padding-left: 2rem;
            margin-bottom: 1.5rem;
            border-left: 1px solid rgba(255, 255, 255, 0.07);
            transition: all 0.2s ease-in-out;
        }

        .timeline-item:hover {
            border-left-color: rgba(255, 68, 51, 0.5);
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            top: 0.35rem;
            left: -0.45rem;
            width: 14px;
            height: 14px;
            background-color: #161615;
            border: 1px solid #3E3E3A;
            border-radius: 50%;
        }

        .custom-link {
            color: #FF4433;
            text-decoration: underline;
            text-underline-offset: 3px;
            transition: all 0.2s ease;
        }

        .custom-link:hover {
            color: #ff6655;
            text-shadow: 0 0 4px rgba(255, 68, 51, 0.5);
        }

        .btn-start {
            background-color: #ededec;
            color: #1c1c1a;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-start:hover {
            background-color: #ffffff;
            transform: scale(1.03);
        }

        .logo-box {
            background: radial-gradient(circle at center, #2c0005, #1D0002);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        .logo-box img {
            max-width: 80%;
            filter: drop-shadow(0 0 5px rgba(255, 255, 255, 0.08));
            transition: transform 0.3s ease;
        }

        .logo-box img:hover {
            transform: scale(1.05);
        }

        @media (max-width: 768px) {
            .logo-box {
                padding: 2rem 1rem;
            }
        }

        #canvas {
            position: absolute;
            z-index: 999;
            pointer-events: auto;
        }

        #canvas:hover {
            cursor: grab;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center min-vh-100 p-3">
    <div class="container" style="max-width: 960px; z-index: 2;">
        <div class="main-card row g-0">
            <!-- LEFT SIDE -->
            <div class="col-lg-7 p-4 p-lg-5">
                <h1 class="h5 mb-1 fw-medium">Selamat Datang di Website Firdan</h1>
                <p class="text-secondary mb-4">Web Ini Merupakan website untuk keperluan pribadi</p>

                <div class="timeline-item text-sm">
                    <small> Sistem
                        <a href="{{ url('signin') }}" class="custom-link ms-2" target="_blank">Kunjungi ↗</a>
                    </small>
                </div>
                <div class="timeline-item text-sm">
                    <small> Website
                        <a href="{{ url('/') }}" class="custom-link ms-2" target="_blank">Coming Soon ↗</a>
                    </small>
                </div>
                <div class="timeline-item text-sm">
                    <small> Portfolio
                        <a href="{{ url('/') }}" class="custom-link ms-2" target="_blank">Coming Soon ↗</a>
                    </small>
                </div>
                <div class="timeline-item text-sm">
                    <small> CV
                        <a href="{{ url('/') }}" class="custom-link ms-2" target="_blank">Coming Soon ↗</a>
                    </small>
                </div>

                <div class="mt-4">
                    <a href="{{ url('/') }}" class="btn btn-start px-4 py-2">Mulai</a>
                </div>
            </div>

            <!-- RIGHT SIDE -->
            <div class="col-lg-5 logo-box">
                <img src="{{ asset('logo-white.png') }}" alt="Logo" />
                <div id="canvas"></div>

            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://threejs.org/examples/js/controls/OrbitControls.js"></script>
    <script>
        const scene = new THREE.Scene();
        const width = 500;
        const height = 500;

        const camera = new THREE.PerspectiveCamera(75, width / height, 0.1, 1000);
        camera.position.z = 4;

        const renderer = new THREE.WebGLRenderer({
            alpha: true,
            antialias: true
        });
        renderer.setSize(width, height);
        document.getElementById("canvas").appendChild(renderer.domElement);

        const radius = 2;
        const dots = 1000;
        const geometry = new THREE.BufferGeometry();
        const positions = [];
        const basePositions = [];

        for (let i = 0; i < dots; i++) {
            const theta = Math.random() * 2 * Math.PI;
            const phi = Math.acos(2 * Math.random() - 1);

            const x = radius * Math.sin(phi) * Math.cos(theta);
            const y = radius * Math.sin(phi) * Math.sin(theta);
            const z = radius * Math.cos(phi);

            positions.push(x, y, z);
            basePositions.push(x, y, z); // buat posisi dasar globe
        }

        geometry.setAttribute('position', new THREE.Float32BufferAttribute(positions, 3));
        const material = new THREE.PointsMaterial({
            color: 0xffffff,
            size: 0.015
        });
        const points = new THREE.Points(geometry, material);
        scene.add(points);

        const controls = new THREE.OrbitControls(camera, renderer.domElement);
        controls.enableZoom = false;
        controls.enablePan = false;
        controls.autoRotate = true;
        controls.autoRotateSpeed = 0.5;

        // Hover untuk matiin autoRotate
        const canvasContainer = document.getElementById("canvas");
        canvasContainer.addEventListener("mouseenter", () => {
            controls.autoRotate = false;
        });
        canvasContainer.addEventListener("mouseleave", () => {
            controls.autoRotate = true;
        });

        let time = 0;

        function animate() {
            requestAnimationFrame(animate);
            controls.update();
            time += 0.01;

            const pos = geometry.attributes.position.array;
            for (let i = 0; i < pos.length; i += 3) {
                const bx = basePositions[i];
                const by = basePositions[i + 1];
                const bz = basePositions[i + 2];

                // Efek getaran hidup
                pos[i] = bx + Math.sin(time + i) * 0.02;
                pos[i + 1] = by + Math.cos(time + i * 1.1) * 0.02;
                pos[i + 2] = bz + Math.sin(time + i * 0.9) * 0.02;
            }

            geometry.attributes.position.needsUpdate = true;
            renderer.render(scene, camera);
        }

        animate();

        window.addEventListener("resize", () => {
            const width = window.innerWidth;
            const height = window.innerHeight;
            camera.aspect = width / height;
            camera.updateProjectionMatrix();
            renderer.setSize(width, height);
        });
    </script>

</body>

</html>
