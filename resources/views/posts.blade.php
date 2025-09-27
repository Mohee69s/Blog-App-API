{{-- resources/views/posts/index.blade.php --}}

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>All Posts</title>
  <style>
    body { font-family: system-ui, sans-serif; background: #f9fafb; margin: 0; padding: 20px; }
    h1 { margin-bottom: 20px; }
    .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; }
    .card { background: #fff; border-radius: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.05); padding: 16px; display:flex; flex-direction:column }
    .card img { width: 100%; height: 180px; object-fit: cover; border-radius: 8px; margin-bottom: 12px; }
    .title { font-weight: 600; font-size: 18px; margin: 0 0 6px; }
    .body { font-size: 14px; color: #374151; flex-grow:1; }
    .meta { font-size: 12px; color: #6b7280; margin-top: 10px; }
  </style>
</head>
<body>
  <h1>All Posts</h1>

  @if(session('success'))
    <div style="background:#ecfdf5;border:1px solid #bbf7d0;padding:10px;border-radius:8px;margin-bottom:12px;color:#065f46">
      {{ session('success') }}
    </div>
  @endif

  <div class="grid">
    @forelse($posts as $post)
      <div class="card">
        @if($post->image)
          <img src="{{ asset('storage/' . $post->image) }}" alt="Post image">
        @endif
        <h2 class="title">{{ $post->title }}</h2>
        <p class="body">{{ Str::limit($post->body, 120) }}</p>
        <div class="meta">
          By {{ $post->user->name ?? 'Anonymous' }} • {{ $post->created_at->diffForHumans() }}
        </div>
      </div>
    @empty
      <p>No posts found.</p>
    @endforelse
  </div>
</body>
</html>
