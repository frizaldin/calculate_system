<?php

namespace Tests\Unit;

use App\Helpers\StatusHelper;
use Tests\TestCase;

class StatusHelperTest extends TestCase
{
    public function test_get_status_text()
    {
        $this->assertEquals('Aktif', StatusHelper::getStatusText(true));
        $this->assertEquals('Nonaktif', StatusHelper::getStatusText(false));
        $this->assertEquals('Tidak Diketahui', StatusHelper::getStatusText(null));
    }

    public function test_get_status_badge()
    {
        $activeBadge = StatusHelper::getStatusBadge(true);
        $inactiveBadge = StatusHelper::getStatusBadge(false);
        $unknownBadge = StatusHelper::getStatusBadge(null);

        $this->assertStringContainsString('bg-success', $activeBadge);
        $this->assertStringContainsString('Aktif', $activeBadge);

        $this->assertStringContainsString('bg-danger', $inactiveBadge);
        $this->assertStringContainsString('Nonaktif', $inactiveBadge);

        $this->assertStringContainsString('bg-secondary', $unknownBadge);
        $this->assertStringContainsString('Tidak Diketahui', $unknownBadge);
    }

    public function test_get_status_icon()
    {
        $activeIcon = StatusHelper::getStatusIcon(true);
        $inactiveIcon = StatusHelper::getStatusIcon(false);
        $unknownIcon = StatusHelper::getStatusIcon(null);

        $this->assertStringContainsString('fa-check-circle', $activeIcon);
        $this->assertStringContainsString('text-success', $activeIcon);

        $this->assertStringContainsString('fa-times-circle', $inactiveIcon);
        $this->assertStringContainsString('text-danger', $inactiveIcon);

        $this->assertStringContainsString('fa-question-circle', $unknownIcon);
        $this->assertStringContainsString('text-secondary', $unknownIcon);
    }

    public function test_get_status_from_text()
    {
        // Test aktif values
        $this->assertTrue(StatusHelper::getStatusFromText('aktif'));
        $this->assertTrue(StatusHelper::getStatusFromText('active'));
        $this->assertTrue(StatusHelper::getStatusFromText('1'));
        $this->assertTrue(StatusHelper::getStatusFromText('true'));
        $this->assertTrue(StatusHelper::getStatusFromText('yes'));

        // Test nonaktif values
        $this->assertFalse(StatusHelper::getStatusFromText('nonaktif'));
        $this->assertFalse(StatusHelper::getStatusFromText('inactive'));
        $this->assertFalse(StatusHelper::getStatusFromText('0'));
        $this->assertFalse(StatusHelper::getStatusFromText('false'));
        $this->assertFalse(StatusHelper::getStatusFromText('no'));

        // Test unknown values
        $this->assertNull(StatusHelper::getStatusFromText('unknown'));
        $this->assertNull(StatusHelper::getStatusFromText(''));
        $this->assertNull(StatusHelper::getStatusFromText('random'));
    }

    public function test_get_status_options()
    {
        $options = StatusHelper::getStatusOptions();

        $this->assertIsArray($options);
        $this->assertArrayHasKey('', $options);
        $this->assertArrayHasKey('1', $options);
        $this->assertArrayHasKey('0', $options);

        $this->assertEquals('Semua Status', $options['']);
        $this->assertEquals('Aktif', $options['1']);
        $this->assertEquals('Nonaktif', $options['0']);
    }

    public function test_get_status_radio_options()
    {
        $options = StatusHelper::getStatusRadioOptions();

        $this->assertIsArray($options);
        $this->assertArrayHasKey('1', $options);
        $this->assertArrayHasKey('0', $options);

        $this->assertEquals('Aktif', $options['1']);
        $this->assertEquals('Nonaktif', $options['0']);
    }

    public function test_is_active()
    {
        $this->assertTrue(StatusHelper::isActive(true));
        $this->assertFalse(StatusHelper::isActive(false));
        $this->assertFalse(StatusHelper::isActive(null));
    }

    public function test_is_inactive()
    {
        $this->assertFalse(StatusHelper::isInactive(true));
        $this->assertTrue(StatusHelper::isInactive(false));
        $this->assertFalse(StatusHelper::isInactive(null));
    }

    public function test_toggle_status()
    {
        $this->assertFalse(StatusHelper::toggleStatus(true));
        $this->assertTrue(StatusHelper::toggleStatus(false));
        $this->assertTrue(StatusHelper::toggleStatus(null));
    }
}

class StatusHelperFunctionsTest extends TestCase
{
    public function test_status_text_function()
    {
        $this->assertEquals('Aktif', status_text(true));
        $this->assertEquals('Nonaktif', status_text(false));
        $this->assertEquals('Tidak Diketahui', status_text(null));
    }

    public function test_status_badge_function()
    {
        $activeBadge = status_badge(true);
        $inactiveBadge = status_badge(false);

        $this->assertStringContainsString('bg-success', $activeBadge);
        $this->assertStringContainsString('Aktif', $activeBadge);

        $this->assertStringContainsString('bg-danger', $inactiveBadge);
        $this->assertStringContainsString('Nonaktif', $inactiveBadge);
    }

    public function test_status_icon_function()
    {
        $activeIcon = status_icon(true);
        $inactiveIcon = status_icon(false);

        $this->assertStringContainsString('fa-check-circle', $activeIcon);
        $this->assertStringContainsString('text-success', $activeIcon);

        $this->assertStringContainsString('fa-times-circle', $inactiveIcon);
        $this->assertStringContainsString('text-danger', $inactiveIcon);
    }

    public function test_status_from_text_function()
    {
        $this->assertTrue(status_from_text('aktif'));
        $this->assertFalse(status_from_text('nonaktif'));
        $this->assertNull(status_from_text('unknown'));
    }

    public function test_status_options_function()
    {
        $options = status_options();

        $this->assertIsArray($options);
        $this->assertArrayHasKey('', $options);
        $this->assertArrayHasKey('1', $options);
        $this->assertArrayHasKey('0', $options);
    }

    public function test_status_radio_options_function()
    {
        $options = status_radio_options();

        $this->assertIsArray($options);
        $this->assertArrayHasKey('1', $options);
        $this->assertArrayHasKey('0', $options);
    }

    public function test_is_status_active_function()
    {
        $this->assertTrue(is_status_active(true));
        $this->assertFalse(is_status_active(false));
        $this->assertFalse(is_status_active(null));
    }

    public function test_is_status_inactive_function()
    {
        $this->assertFalse(is_status_inactive(true));
        $this->assertTrue(is_status_inactive(false));
        $this->assertFalse(is_status_inactive(null));
    }

    public function test_toggle_status_function()
    {
        $this->assertFalse(toggle_status(true));
        $this->assertTrue(toggle_status(false));
        $this->assertTrue(toggle_status(null));
    }
}
