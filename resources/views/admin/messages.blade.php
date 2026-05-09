@extends('layouts.admin')

@section('title', 'Messages')
@section('breadcrumb', 'Inbox')

@section('content')

<div class="table-wrap">
  <div class="table-header">
    <span class="table-header-title">// Client Messages ({{ $messages->total() }})</span>
  </div>

  @if($messages->isEmpty())
    <div class="empty-state">
      <p>No messages yet. When clients contact you, they'll appear here.</p>
    </div>
  @else
    <table>
      <thead>
        <tr>
          <th>From</th>
          <th>Email</th>
          <th>Project</th>
          <th>Budget</th>
          <th>Message</th>
          <th>Date</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($messages as $msg)
        <tr>
          <td style="font-weight:500;">{{ $msg->name }}</td>
          <td>
            <a href="mailto:{{ $msg->email }}" style="font-family:var(--mono);font-size:0.75rem;color:var(--accent);text-decoration:none;">
              {{ $msg->email }}
            </a>
          </td>
          <td>
            <span class="badge-pill badge-yellow">{{ $msg->project_type ?: '—' }}</span>
          </td>
          <td style="font-family:var(--mono);font-size:0.78rem;">{{ $msg->budget ?: '—' }}</td>
          <td style="max-width:260px;font-size:0.85rem;color:var(--muted);">
            {{ Str::limit($msg->message, 80) }}
          </td>
          <td style="font-family:var(--mono);font-size:0.68rem;color:var(--muted);white-space:nowrap;">
            {{ $msg->created_at->format('d M Y') }}<br>{{ $msg->created_at->format('H:i') }}
          </td>
          <td>
            <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST"
                  onsubmit="return confirm('Delete this message?');">
              @csrf @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">Del</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div style="padding:1.5rem;">
      {{ $messages->links() }}
    </div>
  @endif
</div>

@endsection
