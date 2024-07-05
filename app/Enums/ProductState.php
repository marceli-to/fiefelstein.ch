<?php
namespace App\Enums;
enum ProductState: string
{
  case Deliverable = 'deliverable';
  case ReadyForPickup = 'ready_for_pickup';
  case NotAvailable = 'not_available';
  case OnRequest = 'on_request';

  public function label(): string
  {
    return match($this) {
      self::Deliverable => 'lieferbar',
      self::ReadyForPickup => 'abholbereit',
      self::NotAvailable => 'nicht verfügbar',
      self::OnRequest => 'auf Anfrage',
    };
  }

  public function value(): string
  {
    return match($this) {
      self::Deliverable => 'deliverable',
      self::ReadyForPickup => 'ready_for_pickup',
      self::NotAvailable => 'not_available',
      self::OnRequest => 'on_request',
    };
  }

}