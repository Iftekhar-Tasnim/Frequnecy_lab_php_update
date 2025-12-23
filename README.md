# Frequency Lab (F_lab)

Frequency Lab is a Bangladesh-based EdTech social enterprise dedicated to nurturing a new generation of technology innovators through hands-on STEM education in Coding, Electronics, and Robotics.

## 🚀 Technology Stack

- **Backend/Structure**: PHP 8.x (XAMPP Environment)
- **Styling**: Tailwind CSS 3.x with [DaisyUI](https://daisyui.com/)
- **Frontend Logic**: Vanilla JavaScript
- **Typography**: 
  - **Headings**: Exo 2 (Weights 300-800)
  - **Body**: Inter (Weights 300-800)
- **Icons**: Lucide-inspired SVG components

## 📂 Project Structure

```text
├── assets/             # Project assets (Logo, Hero images, Gallery, etc.)
├── css/                # Compiled production CSS (style.css)
├── config/             # Configuration files (db.php, etc.)
├── js/                 # Client-side JavaScript (router.js, main.js)
├── src/                # Source files for development
│   └── input.css      # Core Tailwind CSS entry point
├── index.php           # Main entry point/Home page
├── tailwind.config.js  # Tailwind CSS & DaisyUI configuration
└── package.json        # NPM scripts and dependencies
```

## 🛠️ Development Setup

### 1. Prerequisites
- **XAMPP** or any PHP-ready server (Apache).
- **Node.js** (for Tailwind CSS compilation).

### 2. Installation
Clone this repository into your `htdocs` directory (e.g., `C:\xampp\htdocs\F_lab`).

```bash
cd C:\xampp\htdocs\F_lab
npm install
```

### 3. Tailwind CSS Compilation
To recompile the styles during development:

```bash
# Production Build (Minified)
npm run build

# Development Watch (Real-time updates)
npm run dev
```

## 🎨 Design Guidelines

- **Primary Colors**: 
  - `yale-blue` (#1f9de0)
  - `prussian-blue` (#0a111a)
  - `fresh-sky` (#19a5e6)
  - `platinum` (#eef3f6)
- **Vibe**: Modern, Premium, High-Tech, Socially Impactful.

## 📄 License
© 2024 Frequency Lab. All rights reserved.
