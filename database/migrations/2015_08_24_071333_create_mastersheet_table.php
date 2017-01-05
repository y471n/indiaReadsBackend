<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMastersheetTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('mastersheet', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigInteger('ISBN13')->unique();
            $table->text('FTS')->nullable();
            $table->string('SN', 255)->nullable();
            $table->string('NWS', 100)->nullable();
            $table->string('ISSN', 10)->nullable();
            $table->string('CR1', 3)->nullable();
            $table->string('CRT1', 100)->nullable();
            $table->string('CCI1', 1)->nullable();
            $table->string('CNF1', 255)->nullable();
            $table->string('CR2', 3)->nullable();
            $table->string('CRT2', 100)->nullable();
            $table->string('CCI2', 1)->nullable();
            $table->text('CNF2')->nullable();
            $table->string('CR3', 3)->nullable();
            $table->string('CRT3', 100)->nullable();
            $table->string('CCI3', 1)->nullable();
            $table->text('CNF3')->nullable();
            $table->string('HMM', 4)->nullable();
            $table->string('WMM', 4)->nullable();
            $table->string('SMM', 4)->nullable();
            $table->string('WG', 8)->nullable();
            $table->string('EDSS', 150)->nullable();
            $table->string('PFC', 2)->nullable();
            $table->string('PFCT', 150)->nullable();
            $table->string('PFD1', 4)->nullable();
            $table->string('PFDT1', 4)->nullable();
            $table->string('PCTC1', 2)->nullable();
            $table->string('PCTCT1', 100)->nullable();
            $table->string('PPTC', 2)->nullable();
            $table->string('PPTCT', 100)->nullable();
            $table->string('CIID1', 100)->nullable();
            $table->string('CIIDT1', 2)->nullable();
            $table->string('CIPFC1', 2)->nullable();
            $table->string('CIPFCT1', 150)->nullable();
            $table->string('CINOP1', 4)->nullable();
            $table->string('CIPPTC1', 2)->nullable();
            $table->string('CIPPTCT1', 150)->nullable();
            $table->string('PAGNUM', 50)->nullable();
            $table->string('NOI', 50)->nullable();
            $table->string('RUN', 15)->nullable();
            $table->string('ILL', 400)->nullable();
            $table->string('MS1', 50)->nullable();
            $table->string('MS2', 50)->nullable();
            $table->string('NOP', 4)->nullable();
            $table->text('CIS')->nullable();
            $table->string('EPT', 100)->nullable();
            $table->string('EPTC', 2)->nullable();
            $table->string('EPF', 150)->nullable();
            $table->string('EPFC', 2)->nullable();
            $table->string('EPFS', 255)->nullable();
            $table->string('EPSS', 20)->nullable();
            $table->string('IMPN', 250)->nullable();
            $table->string('PUBN', 250)->nullable();
            $table->string('POP', 100)->nullable();
            $table->string('COP', 100)->nullable();
            $table->string('SLC', 3)->nullable();
            $table->string('SLT', 100)->nullable();
            $table->string('LS', 255)->nullable();
            $table->string('TFC1', 3)->nullable();
            $table->string('TFT1', 100)->nullable();
            $table->string('TS', 200)->nullable();
            $table->string('NAC1', 2)->nullable();
            $table->string('NAT1', 50)->nullable();
            $table->string('OAC1', 2)->nullable();
            $table->string('OAT1', 80)->nullable();
            $table->string('IA', 60)->nullable();
            $table->string('RA', 60)->nullable();
            $table->string('BIC2SC1', 6)->nullable();
            $table->string('BIC2ST1', 100)->nullable();
            $table->string('BIC2QC1', 7)->nullable();
            $table->string('BIC2QT1', 100)->nullable();
            $table->string('BISACSC1', 10)->nullable();
            $table->string('BISACC1', 9)->nullable();
            $table->string('BISACT1', 130)->nullable();
            $table->string('CBMCCODE', 5)->nullable();
            $table->string('PRODCC', 6)->nullable();
            $table->string('PRODCT', 100)->nullable();
            $table->string('LOCC1', 30)->nullable();
            $table->string('LOCSH1', 30)->nullable();
            $table->string('NASF1', 255)->nullable();
            $table->string('NASI1', 255)->nullable();
            $table->string('DATER', 20)->nullable();
            $table->string('FICGH', 130)->nullable();
            $table->string('NCS1', 100)->nullable();
            $table->text('NBDSD')->nullable();
            $table->text('NBDLD')->nullable();
            $table->text('NBDREV')->nullable();
            $table->text('NBDBIOG')->nullable();
            $table->text('NBDP')->nullable();
            $table->text('NBDTOC')->nullable();
            $table->string('PWU1', 255)->nullable();
            $table->string('PWTC1', 2)->nullable();
            $table->string('PWTT1', 150)->nullable();
            $table->string('REPIS13', 13)->nullable();
            $table->string('REPBIS13', 13)->nullable();
            $table->string('PUBAIS13', 13)->nullable();
            $table->string('EPRIS13', 13)->nullable();
            $table->string('EPBIS13', 13)->nullable();
            $table->string('PS1', 255)->nullable();
            $table->text('ERSL')->nullable();
            $table->text('NERSL')->nullable();
            $table->text('NFSRSL')->nullable();
            $table->text('ERSLT')->nullable();
            $table->text('NERSLT')->nullable();
            $table->text('NFSRSLT')->nullable();
            $table->string('RSS', 100)->nullable();
            $table->string('PUBPD', 100)->nullable();
            $table->string('MOPD', 100)->nullable();
            $table->string('CY', 4)->nullable();
            $table->string('PUBSC', 2)->nullable();
            $table->string('PUBST', 50)->nullable();
            $table->string('YFPUB', 4)->nullable();
            $table->string('INRCCPRA', 3)->nullable();
            $table->string('INRCCPRC', 3)->nullable();
            $table->string('INRCCPRRRP', 10)->nullable();
            $table->string('INRCCPRTOP', 10)->nullable();
            $table->string('INRCCPRRRPLT', 10)->nullable();
            $table->string('INRCCPRPN', 80)->nullable();
            $table->string('INRCCPTC', 80)->nullable();
            $table->text('INRCCPTD')->nullable();
            $table->string('INNBDAA', 3)->nullable();
            $table->string('INNBDPAC', 2)->nullable();
            $table->string('INNBDPAT', 60)->nullable();
            $table->string('INNBDEAD', 100)->nullable();
            $table->string('INNBDOT', 5)->nullable();
            $table->string('INNBDPQ', 5)->nullable();
            $table->string('INDDN1', 250)->nullable();
            $table->string('INDDN2', 250)->nullable();
            $table->string('INDDN3', 250)->nullable();
            $table->string('INDDN4', 250)->nullable();
            $table->string('INDDN5', 250)->nullable();
            $table->string('INDDN6', 250)->nullable();
            $table->string('INDDN7', 250)->nullable();
            $table->string('INDDN8', 250)->nullable();
            $table->string('INDDN9', 250)->nullable();
            $table->string('INDDN10', 250)->nullable();
            $table->string('INWDN1', 250)->nullable();
            $table->string('INWDN2', 250)->nullable();
            $table->string('INWDN3', 250)->nullable();
            $table->string('INWDN4', 250)->nullable();
            $table->string('INWDN5', 250)->nullable();
            $table->string('INWDN6', 250)->nullable();
            $table->string('INWDN7', 250)->nullable();
            $table->string('INWDN8', 250)->nullable();
            $table->string('INWDN9', 250)->nullable();
            $table->string('INWDN10', 250)->nullable();
            $table->string('INPDN1', 250)->nullable();
            $table->string('INPDN2', 250)->nullable();
            $table->string('INPDN3', 250)->nullable();
            $table->string('INPDN4', 250)->nullable();
            $table->string('INPDN5', 250)->nullable();
            $table->string('INPDN6', 250)->nullable();
            $table->string('INPDN7', 250)->nullable();
            $table->string('INPDN8', 250)->nullable();
            $table->string('INPDN9', 250)->nullable();
            $table->string('INPDN10', 250)->nullable();
            $table->string('INUDN1', 250)->nullable();
            $table->string('INUDN2', 250)->nullable();
            $table->string('INUDN3', 250)->nullable();
            $table->string('INUDN4', 250)->nullable();
            $table->string('INUDN5', 250)->nullable();
            $table->string('INUDN6', 250)->nullable();
            $table->string('INUDN7', 250)->nullable();
            $table->string('INUDN8', 250)->nullable();
            $table->string('INUDN9', 250)->nullable();
            $table->string('INUDN10', 250)->nullable();
            $table->string('INRDN1', 250)->nullable();
            $table->string('INRDN2', 250)->nullable();
            $table->string('INRDN3', 250)->nullable();
            $table->string('INRDN4', 250)->nullable();
            $table->string('INRDN5', 250)->nullable();
            $table->string('INRDN6', 250)->nullable();
            $table->string('INRDN7', 250)->nullable();
            $table->string('INRDN8', 250)->nullable();
            $table->string('INRDN9', 250)->nullable();
            $table->string('INRDN10', 250)->nullable();
            $table->string('IMAGFLAG', 1)->nullable();
            $table->string('GBPCCPRA', 3)->nullable();
            $table->string('GBPCCPRC', 3)->nullable();
            $table->string('GBPCCPRRRP', 10)->nullable();
            $table->string('GBPCCPRTOP', 10)->nullable();
            $table->string('GBPCCPRRRPLT', 10)->nullable();
            $table->string('GBPCCPRPN', 80)->nullable();
            $table->string('GBPCCPTC', 80)->nullable();
            $table->text('GBPCCPTD')->nullable();
            $table->string('USDCCPRA', 3)->nullable();
            $table->string('USDCCPRC', 3)->nullable();
            $table->string('USDCCPRRRP', 10)->nullable();
            $table->string('USDCCPRTOP', 10)->nullable();
            $table->string('USDCCPRRRPLT', 10)->nullable();
            $table->string('USDCCPRPN', 80)->nullable();
            $table->string('USDCCPTC', 80)->nullable();
            $table->text('USDCCPTD')->nullable();
            $table->string('CADCCPRA', 3)->nullable();
            $table->string('CADCCPRC', 3)->nullable();
            $table->string('CADCCPRRRP', 10)->nullable();
            $table->string('CADCCPRTOP', 10)->nullable();
            $table->string('CADCCPRRRPLT', 10)->nullable();
            $table->string('CADCCPRPN', 80)->nullable();
            $table->string('CADCCPTC', 80)->nullable();
            $table->text('CADCCPTD')->nullable();
            $table->text('AUDCNPRED')->nullable();
            $table->string('AUDCNPRA', 3)->nullable();
            $table->string('AUDCNPRC', 3)->nullable();
            $table->string('AUDCNPRRRP', 10)->nullable();
            $table->string('AUDCNPRTOP', 10)->nullable();
            $table->string('AUDCNPRRRPLT', 10)->nullable();
            $table->string('AUDCNPRPN', 80)->nullable();
            $table->string('AUDCCPTC', 80)->nullable();
            $table->text('AUDCCPTD')->nullable();
            $table->string('NZDCCPRA', 3)->nullable();
            $table->string('NZDCCPRC', 3)->nullable();
            $table->string('NZDCCPRRRP', 10)->nullable();
            $table->string('NZDCCPRTOP', 10)->nullable();
            $table->string('NZDCCPRRRPLT', 10)->nullable();
            $table->string('NZDCCPRPN', 80)->nullable();
            $table->string('NZDCCPTC', 80)->nullable();
            $table->text('NZDCCPTD')->nullable();
            $table->string('ZARCCPRA', 3)->nullable();
            $table->string('ZARCCPRC', 3)->nullable();
            $table->string('ZARCCPRRRP', 10)->nullable();
            $table->string('ZARCCPRTOP', 10)->nullable();
            $table->string('ZARCCPRRRPLT', 10)->nullable();
            $table->string('ZARCCPRPN', 80)->nullable();
            $table->string('ZARCCPTC', 80)->nullable();
            $table->text('ZARCCPTD')->nullable();
            $table->string('EURCCPRA', 3)->nullable();
            $table->string('EURCCPRC', 3)->nullable();
            $table->string('EURCCPRRRP', 10)->nullable();
            $table->string('EURCCPRTOP', 10)->nullable();
            $table->string('EURCCPRRRPLT', 10)->nullable();
            $table->string('EURCCPRPN', 80)->nullable();
            $table->string('EURCCPTC', 80)->nullable();
            $table->text('EURCCPTD')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('mastersheet');
    }
}
