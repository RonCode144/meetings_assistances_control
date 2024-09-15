<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificationReunionCreated extends Notification implements ShouldQueue
{

    use Queueable;

    protected $reureunion;

    protected $reuasistente;

    protected $asunto;

    /**
     * Create a new notification instance.
     */
    public function __construct($reuReunion, $asistente = 0, $asunto = null)
    {
        $this->reureunion = $reuReunion;
        $this->reuasistente = $asistente;
        $this->asunto = $asunto ?? 'Reunión Creada';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // dd($this->reuasistente);
        return (new MailMessage)
            ->subject($this->asunto)
            ->line($this->reureunion->tema)
            ->view('qrcode', [
                'ruta' => route('asistencia.create', [
                    $this->reureunion->id_crypt,
                    $this->reuasistente,
                ]),
                'reuasistente' => $this->reuasistente,
                'reureunion' => $this->reureunion ,
                'fecha' => Carbon::parse($this->reureunion->fechaInicio)->format('d/m/Y H:i')
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
