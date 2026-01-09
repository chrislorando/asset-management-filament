<?php

namespace App\Models;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class MaintenanceTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'asset_id',
        'reported_by',
        'title',
        'description',
        'priority',
        'status',
        'due_date',
        'resolved_at',
    ];

    protected function casts(): array
    {
        return [
            'due_date' => 'date',
            'resolved_at' => 'datetime',
            'priority' => TicketPriority::class,
            'status' => TicketStatus::class,
        ];
    }

    /**
     * Get the asset for the ticket
     */
    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    /**
     * Get the user who reported the ticket
     */
    public function reportedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    /**
     * Generate unique ticket number
     */
    public static function generateTicketNumber(): string
    {
        $prefix = 'TKT';
        $timestamp = now()->format('Ymd');
        $random = strtoupper(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 4));

        return "{$prefix}-{$timestamp}-{$random}";
    }

    /**
     * Boot method to auto-generate ticket number
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ticket) {
            if (empty($ticket->ticket_number)) {
                $ticket->ticket_number = self::generateTicketNumber();
            }
        });
    }

    /**
     * Mark ticket as resolved
     */
    public function markAsResolved(): void
    {
        $this->status = TicketStatus::RESOLVED;
        $this->resolved_at = now();
        $this->save();
    }

    /**
     * Mark ticket as closed
     */
    public function markAsClosed(): void
    {
        $this->status = TicketStatus::CLOSED;
        if (!$this->resolved_at) {
            $this->resolved_at = now();
        }
        $this->save();
    }

    /**
     * Scope to filter open tickets
     */
    public function scopeOpen($query)
    {
        return $query->where('status', TicketStatus::OPEN);
    }

    /**
     * Scope to filter by priority
     */
    public function scopeByPriority($query, TicketPriority $priority)
    {
        return $query->where('priority', $priority);
    }

    /**
     * Scope to filter by status
     */
    public function scopeByStatus($query, TicketStatus $status)
    {
        return $query->where('status', $status);
    }
}
