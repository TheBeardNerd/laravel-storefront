{{ $activity->user->name }} {{ $activity->subject->approved ? 'approved' : 'disapproved' }} "{{ $activity->subject->question }}" by {{ $activity->subject->author }}
