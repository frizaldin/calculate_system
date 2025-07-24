<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dark Elegant Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        /* Custom Cursor */
        body {
            cursor: none;
        }

        .custom-cursor {
            position: fixed;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: rgba(139, 92, 246, 0.5);
            pointer-events: none;
            z-index: 9999;
            transition: transform 0.2s ease, opacity 0.2s ease;
            mix-blend-mode: difference;
        }

        .cursor-follower {
            position: fixed;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid rgba(139, 92, 246, 0.3);
            pointer-events: none;
            z-index: 9998;
            transition: transform 0.4s ease-out, opacity 0.2s ease;
            mix-blend-mode: difference;
        }

        :root {
            --primary: #8b5cf6;
            --secondary: #7c3aed;
            --accent: #ec4899;
            --dark: #0f172a;
            --darker: #020617;
            --light: #e2e8f0;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--darker);
            color: var(--light);
            overflow-x: hidden;
        }

        .glass-card {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .gradient-text {
            background: linear-gradient(90deg, var(--primary), var(--accent));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .gradient-border {
            position: relative;
        }

        .gradient-border::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: inherit;
            padding: 2px;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            -webkit-mask:
                linear-gradient(#fff 0 0) content-box,
                linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            pointer-events: none;
        }

        .floating {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .pulse {
            animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .shine:hover {
            position: relative;
            overflow: hidden;
        }

        .shine:hover::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -60%;
            width: 200%;
            height: 200%;
            opacity: 0;
            transform: rotate(30deg);
            background: rgba(255, 255, 255, 0.13);
            background: linear-gradient(to right,
                    rgba(255, 255, 255, 0) 0%,
                    rgba(255, 255, 255, 0.03) 77%,
                    rgba(255, 255, 255, 0.5) 92%,
                    rgba(255, 255, 255, 0) 100%);
            animation: shine 1.5s ease-out 0s;
        }

        @keyframes shine {
            10% {
                opacity: 1;
                left: 100%;
            }

            100% {
                left: 100%;
                opacity: 0;
            }
        }

        .neon-text {
            text-shadow: 0 0 5px var(--primary), 0 0 10px rgba(139, 92, 246, 0.5);
        }

        .glow {
            box-shadow: 0 0 15px rgba(139, 92, 246, 0.5);
        }

        .slide-in {
            animation: slideIn 1s ease-out forwards;
            opacity: 0;
        }

        @keyframes slideIn {
            from {
                transform: translateY(50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .delay-100 {
            animation-delay: 100ms;
        }

        .delay-200 {
            animation-delay: 200ms;
        }

        .delay-300 {
            animation-delay: 300ms;
        }
    </style>
</head>

<body class="bg-darker text-light">
    <div class="custom-cursor"></div>
    <div class="cursor-follower"></div>
    <!-- Navigation -->
    <nav
        class="fixed w-full z-50 bg-darker/80 backdrop-blur-md border-b border-gray-800 animate__animated animate__fadeIn">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <a href="#" class="flex items-center text-2xl font-bold">
                    <span class="gradient-text">Portfolio</span>
                </a>

                <div class="hidden md:flex space-x-8">
                    <a href="#home" class="relative px-3 py-2 text-sm font-medium group">
                        <span class="gradient-text">Home</span>
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-accent transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#about" class="relative px-3 py-2 text-sm font-medium group">
                        <span class="gradient-text">About</span>
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-accent transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#projects" class="relative px-3 py-2 text-sm font-medium group">
                        <span class="gradient-text">Projects</span>
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-accent transition-all duration-300 group-hover:w-full"></span>
                    </a>
                    <a href="#contact" class="relative px-3 py-2 text-sm font-medium group">
                        <span class="gradient-text">Contact</span>
                        <span
                            class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-primary to-accent transition-all duration-300 group-hover:w-full"></span>
                    </a>
                </div>

                <div class="md:hidden">
                    <button class="p-2 focus:outline-none">
                        <svg class="w-6 h-6 text-light" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="min-h-screen pt-32 pb-24 relative overflow-hidden">
        <div class="absolute inset-0 -z-10">
            <div class="absolute inset-0 bg-gradient-to-b from-darker/90 to-darker"></div>
            <img src="https://images.unsplash.com/photo-1639754390580-2e7437267698?q=80&w=2940&auto=format&fit=crop"
                alt="Abstract dark background with glowing particles" class="w-full h-full object-cover opacity-20">
            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-transparent via-darker/80 to-darker">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="space-y-8 slide-in">
                    <h1 class="text-5xl md:text-6xl font-bold leading-tight">
                        <span class="block">Hi, I'm</span>
                        <span class="gradient-text">Full Name</span>
                    </h1>
                    <p class="text-xl text-gray-300 max-w-lg">
                        Professional <span class="gradient-text font-medium">Job Title</span> with X+ years of
                        experience creating digital experiences.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#contact"
                            class="px-8 py-3.5 bg-gradient-to-r from-primary to-accent text-white font-medium rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 relative overflow-hidden shine">
                            Contact Me
                        </a>
                        <a href="#projects"
                            class="px-8 py-3.5 border border-gray-700 text-white font-medium rounded-full hover:border-primary/0 hover:bg-gradient-to-r hover:from-primary/10 hover:to-accent/10 transition-all duration-300 group">
                            <span class="gradient-text group-hover:text-transparent">View Work</span>
                        </a>
                    </div>
                </div>

                <div class="relative h-full flex justify-center">
                    <div class="relative floating">
                        <div
                            class="absolute -inset-4 bg-gradient-to-r from-primary to-accent rounded-3xl opacity-75 blur-xl">
                        </div>
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=2940&auto=format&fit=crop"
                            alt="Professional portrait with formal attire and studio lighting"
                            class="relative rounded-2xl w-80 h-80 md:w-96 md:h-96 object-cover z-10 border-2 border-gray-800">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-bold mb-4 slide-in">
                    <span class="gradient-text">About Me</span>
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-primary to-accent mx-auto rounded-full slide-in delay-100">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="relative slide-in delay-100">
                    <div
                        class="absolute -inset-4 bg-gradient-to-r from-primary to-accent rounded-2xl opacity-30 blur-xl z-0">
                    </div>
                    <div class="glass-card rounded-2xl p-1 h-full relative z-10 gradient-border">
                        <div class="bg-darker rounded-xl overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1496200186974-4293800e2c20?q=80&w=2832&auto=format&fit=crop"
                                alt="Person working on modern laptop in dark themed workspace"
                                class="w-full h-auto object-cover">
                            <div class="p-6 text-center">
                                <div class="flex justify-center space-x-4">
                                    <div
                                        class="bg-gradient-to-r from-primary to-accent p-2 rounded-lg inline-flex items-center">
                                        <span class="text-xs font-medium">X+ Years Experience</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6 slide-in delay-200">
                    <h3 class="text-3xl font-bold">I create digital experiences that matter</h3>
                    <p class="text-gray-400 leading-relaxed">
                        With a background in [your field], I bring a unique perspective to every project. My approach
                        combines technical expertise with creative problem-solving to deliver solutions that exceed
                        expectations.
                    </p>
                    <p class="text-gray-400 leading-relaxed">
                        Throughout my career, I've had the privilege of working with clients across various industries,
                        helping them transform their ideas into exceptional digital products.
                    </p>

                    <div class="grid grid-cols-2 gap-4">
                        <div
                            class="glass-card rounded-xl p-5 hover:bg-gray-900/50 transition-all duration-300 border border-gray-800 hover:border-primary/30">
                            <h4 class="font-bold text-primary mb-2">Philosophy</h4>
                            <p class="text-sm text-gray-400">Quality over quantity with focus on elegant solutions</p>
                        </div>
                        <div
                            class="glass-card rounded-xl p-5 hover:bg-gray-900/50 transition-all duration-300 border border-gray-800 hover:border-accent/30">
                            <h4 class="font-bold text-accent mb-2">Approach</h4>
                            <p class="text-sm text-gray-400">Detail-oriented process with clear communication</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="py-20 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-bold mb-4 slide-in">
                    <span class="gradient-text">Featured Work</span>
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-primary to-accent mx-auto rounded-full slide-in delay-100">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Project 1 -->
                <div
                    class="glass-card rounded-2xl overflow-hidden border border-gray-800 hover:border-primary/30 transition-all duration-500 hover:-translate-y-2 slide-in delay-100 shine">
                    <div class="relative h-56 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=2940&auto=format&fit=crop"
                            alt="Modern analytics dashboard with data visualizations"
                            class="w-full h-full object-cover transition-all duration-500 hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-darker/80 via-darker/20 to-transparent">
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-xl font-bold">Analytics Platform</h3>
                            <span
                                class="px-3 py-1 bg-primary/10 text-primary text-xs font-medium rounded-full">Web</span>
                        </div>
                        <p class="text-gray-400 text-sm mb-5">Advanced analytics dashboard with real-time data
                            visualization</p>
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-primary hover:text-accent transition-colors duration-300">
                            View Project
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Project 2 -->
                <div
                    class="glass-card rounded-2xl overflow-hidden border border-gray-800 hover:border-primary/30 transition-all duration-500 hover:-translate-y-2 slide-in delay-200 shine">
                    <div class="relative h-56 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1614680376573-df3480f0c6ff?q=80&w=3174&auto=format&fit=crop"
                            alt="Mobile app interface for fitness tracking"
                            class="w-full h-full object-cover transition-all duration-500 hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-darker/80 via-darker/20 to-transparent">
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-xl font-bold">Fitness Tracker</h3>
                            <span
                                class="px-3 py-1 bg-accent/10 text-accent text-xs font-medium rounded-full">Mobile</span>
                        </div>
                        <p class="text-gray-400 text-sm mb-5">Personalized workout and nutrition tracking application
                        </p>
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-primary hover:text-accent transition-colors duration-300">
                            View Project
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Project 3 -->
                <div
                    class="glass-card rounded-2xl overflow-hidden border border-gray-800 hover:border-primary/30 transition-all duration-500 hover:-translate-y-2 slide-in delay-300 shine">
                    <div class="relative h-56 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1555529669-e69e7aa0ba9a?q=80&w=3174&auto=format&fit=crop"
                            alt="E-commerce website showcase on multiple devices"
                            class="w-full h-full object-cover transition-all duration-500 hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-darker/80 via-darker/20 to-transparent">
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-3">
                            <h3 class="text-xl font-bold">E-Commerce Store</h3>
                            <span
                                class="px-3 py-1 bg-purple-500/10 text-purple-500 text-xs font-medium rounded-full">Web</span>
                        </div>
                        <p class="text-gray-400 text-sm mb-5">Modern online store with AI-powered recommendations</p>
                        <a href="#"
                            class="inline-flex items-center text-sm font-medium text-primary hover:text-accent transition-colors duration-300">
                            View Project
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-16 slide-in delay-300">
                <a href="#"
                    class="inline-flex items-center px-8 py-3.5 bg-gradient-to-r from-primary to-accent text-white font-medium rounded-full shadow-lg hover:shadow-xl transition-all duration-300 relative overflow-hidden shine">
                    View All Projects
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 slide-in">
                    <span class="gradient-text">Get In Touch</span>
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-primary to-accent mx-auto rounded-full slide-in delay-100">
                </div>
            </div>

            <div class="glass-card rounded-2xl p-8 border border-gray-800">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div>
                        <h3 class="text-2xl font-bold mb-6">Let's work together</h3>
                        <p class="text-gray-400 mb-8 leading-relaxed">
                            Have a project in mind or want to discuss potential collaborations? Feel free to reach out
                            through the form or directly using the contact details below.
                        </p>

                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-3 rounded-lg bg-primary/10 text-primary">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-500">Phone</h4>
                                    <p class="text-gray-300">+62 123-4567-890</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0 p-3 rounded-lg bg-accent/10 text-accent">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-sm font-medium text-gray-500">Email</h4>
                                    <p class="text-gray-300">contact@example.com</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10">
                            <h4 class="text-sm font-medium text-gray-500 mb-4">Follow Me</h4>
                            <div class="flex space-x-4">
                                <a href="#"
                                    class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-300 hover:text-primary hover:bg-gray-700 transition-colors duration-300">
                                    <span class="sr-only">Twitter</span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84">
                                        </path>
                                    </svg>
                                </a>
                                <a href="#"
                                    class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-300 hover:text-primary hover:bg-gray-700 transition-colors duration-300">
                                    <span class="sr-only">GitHub</span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                                <a href="#"
                                    class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-300 hover:text-primary hover:bg-gray-700 transition-colors duration-300">
                                    <span class="sr-only">LinkedIn</span>
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div>
                        <form class="space-y-6">
                            <div>
                                <label for="name"
                                    class="block text-sm font-medium text-gray-400 mb-1">Name</label>
                                <input type="text" id="name"
                                    class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none transition-all duration-300"
                                    placeholder="Your name">
                            </div>
                            <div>
                                <label for="email"
                                    class="block text-sm font-medium text-gray-400 mb-1">Email</label>
                                <input type="email" id="email"
                                    class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none transition-all duration-300"
                                    placeholder="your@email.com">
                            </div>
                            <div>
                                <label for="message"
                                    class="block text-sm font-medium text-gray-400 mb-1">Message</label>
                                <textarea id="message" rows="5"
                                    class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent focus:outline-none transition-all duration-300"
                                    placeholder="Your message"></textarea>
                            </div>
                            <button type="submit"
                                class="w-full px-6 py-3.5 bg-gradient-to-r from-primary to-accent text-white font-medium rounded-lg hover:opacity-90 transition-all duration-300 transform hover:-translate-y-0.5 flex items-center justify-center relative overflow-hidden shine">
                                Send Message
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-10 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center mb-4 md:mb-0">
                    <a href="#" class="text-2xl font-bold">
                        <span class="gradient-text">Portfolio</span>
                    </a>
                </div>
                <div class="text-sm text-gray-400">
                    © 2023 Your Name. All rights reserved.
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Custom cursor interaction
        const cursor = document.querySelector('.custom-cursor');
        const cursorFollower = document.querySelector('.cursor-follower');

        document.addEventListener('mousemove', (e) => {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';

            setTimeout(() => {
                cursorFollower.style.left = e.clientX + 'px';
                cursorFollower.style.top = e.clientY + 'px';
            }, 100);
        });

        // Hover effects
        document.querySelectorAll('a, button, [role=button]').forEach(el => {
            el.addEventListener('mouseenter', () => {
                cursor.style.transform = 'scale(2)';
                cursor.style.backgroundColor = 'rgba(236, 72, 153, 0.7)';
                cursorFollower.style.transform = 'scale(0.5)';
            });
            el.addEventListener('mouseleave', () => {
                cursor.style.transform = 'scale(1)';
                cursor.style.backgroundColor = 'rgba(139, 92, 246, 0.5)';
                cursorFollower.style.transform = 'scale(1)';
            });
        });

        // Simple scroll animation trigger
        document.addEventListener('DOMContentLoaded', () => {
            const elements = document.querySelectorAll('.slide-in');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = 1;
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, {
                threshold: 0.1
            });

            elements.forEach(el => {
                observer.observe(el);
            });

            // Mobile menu toggle would go here
        });
    </script>
</body>

</html>
