/**
 * Hero 3D scene — floating clay-like shapes in the Atelier palette.
 * Matte terracotta / kraft / sage / cream primitives with soft studio light,
 * slow idle rotation and a gentle mouse parallax. Renders on a transparent
 * canvas so the animated gradient orbs show through.
 */
import * as THREE from 'three';

export function initHeroScene(root = document) {
    const canvas = root.querySelector('[data-hero-canvas]');
    if (!canvas) return;

    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const renderer = new THREE.WebGLRenderer({
        canvas,
        alpha: true,
        antialias: true,
    });
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));

    const scene = new THREE.Scene();

    const camera = new THREE.PerspectiveCamera(38, 1, 0.1, 100);
    camera.position.set(0, 0.2, 9);

    // ---- soft studio lighting -------------------------------------------------
    scene.add(new THREE.AmbientLight(0xf5efe4, 0.9));

    const key = new THREE.DirectionalLight(0xfff3e6, 2.2);
    key.position.set(4, 6, 5);
    scene.add(key);

    const fill = new THREE.DirectionalLight(0xe7dfd0, 0.8);
    fill.position.set(-5, -1, 3);
    scene.add(fill);

    const rim = new THREE.DirectionalLight(0xd97757, 1.4);
    rim.position.set(-2, 4, -6);
    scene.add(rim);

    // ---- materials: matte clay finish ----------------------------------------
    const clay = (hex) =>
        new THREE.MeshStandardMaterial({ color: hex, roughness: 0.62, metalness: 0.04 });

    const group = new THREE.Group();
    scene.add(group);

    const shapes = [];

    const add = (mesh, { pos = [0, 0, 0], scale = 1, speed = 0.3, bob = 0.25, phase = 0, axis = 'z' }) => {
        mesh.position.set(...pos);
        mesh.scale.setScalar(scale);
        mesh.userData = { speed, bob, phase, baseY: pos[1], axis };
        group.add(mesh);
        shapes.push(mesh);
        return mesh;
    };

    // hero torus "wreath" — terracotta
    add(new THREE.Mesh(new THREE.TorusGeometry(1.55, 0.52, 48, 96), clay(0xd97757)), {
        pos: [0, 0.1, 0], speed: 0.22, bob: 0.22, phase: 0,
    });

    // kraft sphere
    add(new THREE.Mesh(new THREE.SphereGeometry(0.85, 48, 48), clay(0xc89b7b)), {
        pos: [2.35, 1.35, -0.6], scale: 0.9, speed: 0.35, bob: 0.3, phase: 1.4,
    });

    // cream sphere, small
    add(new THREE.Mesh(new THREE.SphereGeometry(0.55, 40, 40), clay(0xf0eee6)), {
        pos: [-2.3, 1.15, -0.4], speed: -0.28, bob: 0.34, phase: 2.6,
    });

    // sage capsule
    const capsule = new THREE.Mesh(new THREE.CapsuleGeometry(0.42, 0.9, 12, 32), clay(0xa3b295));
    capsule.rotation.z = 0.8;
    add(capsule, { pos: [-1.95, -1.35, 0.7], speed: 0.4, bob: 0.26, phase: 4.1 });

    // charcoal small torus
    add(new THREE.Mesh(new THREE.TorusGeometry(0.55, 0.24, 32, 64), clay(0x141413)), {
        pos: [2.1, -1.5, 0.5], speed: -0.45, bob: 0.3, phase: 5.2,
    });

    // ochre cone
    add(new THREE.Mesh(new THREE.ConeGeometry(0.5, 1.1, 40), clay(0xd4a27f)), {
        pos: [0.15, 2.35, -1.4], scale: 0.85, speed: 0.5, bob: 0.24, phase: 3.3,
    });

    // tiny floating beads
    const beadGeo = new THREE.SphereGeometry(0.14, 24, 24);
    [[-1.1, 2.3, 0.4], [1.35, 2.5, -0.2], [-3.0, -0.4, 0.9], [3.1, 0.2, 0.8], [0.9, -2.35, 1.0]].forEach(
        (p, i) => {
            add(new THREE.Mesh(beadGeo, clay(i % 2 ? 0xd97757 : 0x141413)), {
                pos: p, speed: 0.6 + i * 0.1, bob: 0.35, phase: i * 1.7,
            });
        },
    );

    // ---- mouse parallax --------------------------------------------------------
    let targetX = 0;
    let targetY = 0;
    const onPointer = (e) => {
        const nx = (e.clientX / window.innerWidth) * 2 - 1;
        const ny = (e.clientY / window.innerHeight) * 2 - 1;
        targetY = nx * 0.22;
        targetX = ny * 0.14;
    };
    window.addEventListener('pointermove', onPointer, { passive: true });

    // ---- resize ------------------------------------------------------------------
    const resize = () => {
        const { clientWidth: w, clientHeight: h } = canvas.parentElement;
        renderer.setSize(w, h, false);
        camera.aspect = w / h;
        camera.updateProjectionMatrix();
    };
    resize();
    window.addEventListener('resize', resize);

    // ---- loop ---------------------------------------------------------------------
    const clock = new THREE.Clock();
    let visible = true;
    document.addEventListener('visibilitychange', () => (visible = !document.hidden));

    const renderFrame = () => {
        const t = clock.getElapsedTime();

        if (!prefersReduced) {
            for (const s of shapes) {
                const { speed, bob, phase, baseY } = s.userData;
                s.rotation.x = t * speed * 0.6;
                s.rotation.y = t * speed;
                s.position.y = baseY + Math.sin(t * 0.8 + phase) * bob;
            }
            group.rotation.x += (targetX - group.rotation.x) * 0.04;
            group.rotation.y += (targetY - group.rotation.y) * 0.04;
        }

        renderer.render(scene, camera);
    };

    if (prefersReduced) {
        renderFrame();
        window.addEventListener('resize', renderFrame);
        return;
    }

    renderer.setAnimationLoop(() => visible && renderFrame());
}

// Initial page load + subsequent Livewire navigations
const start = () => initHeroScene(document);
document.readyState === 'loading'
    ? document.addEventListener('DOMContentLoaded', start)
    : start();

document.addEventListener('livewire:navigated', start);
