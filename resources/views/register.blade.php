<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Register - MyApp</title>
  <style>
    :root{ --bg:#f5f7fb; --card:#ffffff; --accent:#2563eb; --muted:#6b7280; --danger:#dc2626 }
    *{box-sizing:border-box}
    body{margin:0;font-family:Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",Roboto,'Helvetica Neue',Arial;background:var(--bg);color:#0f172a}
    .wrap{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:32px}
    .card{width:100%;max-width:720px;background:var(--card);border-radius:12px;box-shadow:0 8px 30px rgba(2,6,23,0.08);display:grid;grid-template-columns:1fr 1fr;overflow:hidden}
    .left{padding:36px 32px;border-right:1px solid rgba(15,23,42,0.04)}
    .right{background:linear-gradient(180deg, rgba(37,99,235,0.06), rgba(99,102,241,0.02));display:flex;align-items:center;justify-content:center;padding:24px}
    h1{margin:0 0 8px;font-size:20px}
    p.lead{margin:0 0 18px;color:var(--muted);font-size:14px}
    form{display:grid;gap:12px}
    label{display:block;font-size:13px;margin-bottom:6px;color:#0f172a}
    input[type="text"],input[type="email"],input[type="password"],input[type="file"]{width:100%;padding:10px 12px;border:1px solid #e6e9ef;border-radius:8px;font-size:14px}
    .row{display:grid;grid-template-columns:1fr 1fr;gap:12px}
    .btn{display:inline-block;padding:10px 14px;border-radius:8px;background:var(--accent);color:#fff;text-decoration:none;border:none;cursor:pointer;font-weight:600}
    .muted{font-size:13px;color:var(--muted)}
    .small{font-size:13px}
    .error{color:var(--danger);font-size:13px;margin-top:6px}
    .preview{width:140px;height:140px;border-radius:8px;border:1px dashed rgba(2,6,23,0.06);display:flex;align-items:center;justify-content:center;overflow:hidden;background:#fff}
    .preview img{width:100%;height:100%;object-fit:cover}
    .form-footer{display:flex;justify-content:space-between;align-items:center;margin-top:8px}
    @media (max-width:760px){.card{grid-template-columns:1fr}.left{border-right:none}.right{display:none}}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="card" role="main">
      <div class="left">
        <h1>Create your account</h1>
        <p class="lead">Simple registration form — name, email, password and profile picture.</p>

        <!-- Display session success / error messages -->
        @if(session('success'))
          <div style="background:#ecfdf5;border:1px solid #bbf7d0;padding:10px;border-radius:8px;margin-bottom:12px;color:#065f46">{{ session('success') }}</div>
        @endif
        @if(session('error'))
          <div style="background:#fff1f2;border:1px solid #fecaca;padding:10px;border-radius:8px;margin-bottom:12px;color:#7f1d1d">{{ session('error') }}</div>
        @endif

        <form action="/register" method="POST" enctype="multipart/form-data" novalidate>
          @csrf

          <div>
            <label for="name">Full name</label>
            <input id="name" name="name" type="text" value="{{ old('name') }}" required aria-required="true" placeholder="Jane Doe">
            @error('name') <div class="error">{{ $message }}</div> @enderror
          </div>

          <div>
            <label for="email">Email address</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required placeholder="you@example.com">
            @error('email') <div class="error">{{ $message }}</div> @enderror
          </div>

          <div>
            <label for="password">Password</label>
            <input id="password" name="password" type="password" required placeholder="Choose a strong password">
            @error('password') <div class="error">{{ $message }}</div> @enderror
          </div>
          <div>
            <label for="password_confirmation">Password confirmation</label>
            <input type="password_confirmation" name="password_confirmation" id="password_confirmation">
            @error('password_confirmation') <div class="error"> {{ $message }}</div>@enderror
          </div>

          <div style="display:flex;gap:12px;align-items:center;margin-top:6px">
            <div style="flex:1">
              <label for="picture">Profile picture</label>
              <input id="picture" name="picture" type="file" accept="image/*" onchange="previewImage(event)">
              @error('picture') <div class="error">{{ $message }}</div> @enderror
              <div class="muted small" style="margin-top:6px">Optional. Max file size: 2MB (server-side enforced)</div>
            </div>
            <div class="preview" id="preview" aria-hidden="true"><span class="muted">No image</span></div>
          </div>

          <div class="form-footer">
            <div class="muted small">Already have an account? <a href="/login">Sign in</a></div>
            <button class="btn" type="submit">Register</button>
          </div>
        </form>

      </div>
      <div class="right">
        <div style="max-width:260px;text-align:center">
          <h2 style="margin:0 0 8px">Welcome!</h2>
          <p class="muted">Upload a profile picture or continue without one. We only store a single avatar and keep passwords hashed.</p>
        </div>
      </div>
    </div>
  </div>

  <script>
    function previewImage(e){
      const file = e.target.files && e.target.files[0]
      const holder = document.getElementById('preview')
      holder.innerHTML = ''
      if(!file) { holder.innerHTML = '<span class="muted">No image</span>'; return }
      if(!file.type.startsWith('image/')) { holder.innerHTML = '<span class="muted">Invalid file</span>'; return }
      const img = document.createElement('img')
      img.alt = 'Selected image preview'
      img.src = URL.createObjectURL(file)
      img.onload = ()=> URL.revokeObjectURL(img.src)
      holder.appendChild(img)
    }
  </script>
</body>
</html>
